<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::with('classRoom', 'user')->latest();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $students = $query->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassRoom::orderBy('name')->get();
        return view('admin.students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'class_room_id' => 'required|exists:class_rooms,id',
            'nis' => 'required|string|max:20|unique:students,nis',
            'nisn' => 'required|string|max:20|unique:students,nisn',
            'gender' => 'required|in:male,female',
            'entry_year' => 'required|digits:4|integer|min:2000',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // 1. Create User
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student', // Set role default ke 'siswa'
            ]);

            // 2. Create Student
            Student::create([
                'user_id' => $user->id,
                'class_room_id' => $request->class_room_id,
                'full_name' => $request->full_name,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'gender' => $request->gender,
                'entry_year' => $request->entry_year,
                'phone' => $request->phone,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
            ]);

            DB::commit();

            return redirect()->route('admin.students.index')
                         ->with('success', 'Siswa berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Optional: Log the exception
            // Log::error('Failed to create student: ' . $e->getMessage());
            
            return redirect()->back()
                         ->with('error', 'Terjadi kesalahan. Gagal menambahkan siswa.')
                         ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('classRoom', 'user');
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = ClassRoom::orderBy('name')->get();
        $student->load('user');
        return view('admin.students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($student->user_id)],
            'class_room_id' => 'required|exists:class_rooms,id',
            'nis' => ['required', 'string', 'max:20', Rule::unique('students')->ignore($student->id)],
            'nisn' => ['required', 'string', 'max:20', Rule::unique('students')->ignore($student->id)],
            'gender' => 'required|in:male,female',
            'entry_year' => 'required|digits:4|integer|min:2000',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:100',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction();
        try {
            // 1. Update User
            $user = $student->user;
            $user->name = $request->full_name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // 2. Update Student
            $student->update($request->except(['email', 'password', 'password_confirmation']));
            
            DB::commit();

            return redirect()->route('admin.students.index')
                         ->with('success', 'Data siswa berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                         ->with('error', 'Terjadi kesalahan. Gagal memperbarui data siswa.')
                         ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();
        try {
            // Also delete the associated user
            $student->user()->delete();
            $student->delete();
            
            DB::commit();
            return redirect()->route('admin.students.index')
                         ->with('success', 'Siswa berhasil dihapus.');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.students.index')
                         ->with('error', 'Gagal menghapus siswa.');
        }
    }
}