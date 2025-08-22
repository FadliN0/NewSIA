<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subject::with('teachers')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        $subjects = $query->paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::orderBy('full_name')->get();
        return view('admin.subjects.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name',
            'code' => 'required|string|max:20|unique:subjects,code',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $subject = Subject::create($request->only('name', 'code', 'description'));
            
            // Attach the teacher to the subject
            $subject->teachers()->attach($request->teacher_id);

            DB::commit();
            return redirect()->route('admin.subjects.index')
                         ->with('success', 'Mata pelajaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                         ->with('error', 'Gagal menambahkan mata pelajaran.')
                         ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $teachers = Teacher::orderBy('full_name')->get();
        
        // Eager load teachers relation to get the assigned one
        $subject->load('teachers');
        
        // Get the ID of the first teacher in the relationship collection
        $assigned_teacher_id = $subject->teachers->first()->id ?? null;

        return view('admin.subjects.edit', compact('subject', 'teachers', 'assigned_teacher_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'code' => 'required|string|max:20|unique:subjects,code,' . $subject->id,
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:teachers,id', // Pastikan teacher_id ada dan valid
        ]);

        // Jika validasi gagal, Laravel akan otomatis redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            // Update data di tabel 'subjects'
            $subject->update($request->only('name', 'code', 'description'));

            // Sinkronisasi data di tabel pivot 'teacher_subjects'
            // .sync() akan menghapus relasi lama dan membuat yang baru sesuai input
            $subject->teachers()->sync([$request->teacher_id]);
            
            DB::commit();

            // Jika berhasil, kembali ke halaman index dengan pesan sukses
            return redirect()->route('admin.subjects.index')
                         ->with('success', 'Mata pelajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Jika ada error database, kembali ke form dengan pesan error
            return redirect()->back()
                         ->with('error', 'Terjadi kesalahan pada database. Gagal memperbarui.')
                         ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        DB::beginTransaction();
        try {
            // Detach all teachers before deleting
            $subject->teachers()->detach();
            $subject->delete();

            DB::commit();
            return redirect()->route('admin.subjects.index')
                         ->with('success', 'Mata pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.subjects.index')
                         ->with('error', 'Gagal menghapus mata pelajaran.');
        }
    }
}