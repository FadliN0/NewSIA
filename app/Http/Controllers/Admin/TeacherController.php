<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Teacher::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $teachers = $query->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
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
            'nip' => 'required|string|max:20|unique:teachers,nip',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'education_level' => 'nullable|string|max:50',
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
                'role' => 'teacher', // Set role default ke 'guru'
            ]);

            // 2. Create Teacher
            Teacher::create([
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'education_level' => $request->education_level,
            ]);

            DB::commit();

            return redirect()->route('admin.teachers.index')
                         ->with('success', 'Guru berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                         ->with('error', 'Terjadi kesalahan. Gagal menambahkan guru.')
                         ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($teacher->user_id)],
            'nip' => ['required', 'string', 'max:20', Rule::unique('teachers')->ignore($teacher->id)],
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'education_level' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // 1. Update User
            $user = $teacher->user;
            $user->name = $request->full_name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // 2. Update Teacher
            $teacher->update($request->except(['email', 'password', 'password_confirmation']));

            DB::commit();

            return redirect()->route('admin.teachers.index')
                         ->with('success', 'Data guru berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                         ->with('error', 'Terjadi kesalahan. Gagal memperbarui data guru.')
                         ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            // Delete associated user
            $teacher->user()->delete();
            $teacher->delete();
            
            DB::commit();
            return redirect()->route('admin.teachers.index')
                         ->with('success', 'Guru berhasil dihapus.');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.teachers.index')
                         ->with('error', 'Gagal menghapus guru.');
        }
    }
}