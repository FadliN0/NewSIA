<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('teachers')->latest()->paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('full_name')->get();
        return view('admin.subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name',
            'code' => 'required|string|max:20|unique:subjects,code',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $subject = Subject::create($request->only('name', 'code', 'description'));
            $subject->teachers()->attach($request->teacher_id);
            DB::commit();

            return redirect()->route('admin.subjects.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Subject $subject)
    {
        $teachers = Teacher::orderBy('full_name')->get();
        $subject->load('teachers');
        $assigned_teacher_id = $subject->teachers->first()->id ?? null;

        return view('admin.subjects.edit', compact('subject', 'teachers', 'assigned_teacher_id'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('subjects')->ignore($subject->id)],
            'code' => ['required', 'string', 'max:20', Rule::unique('subjects')->ignore($subject->id)],
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $subject->update($request->only('name', 'code', 'description'));
            $subject->teachers()->sync($request->teacher_id);
            DB::commit();

            return redirect()->route('admin.subjects.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Subject $subject)
    {
        try {
            DB::beginTransaction();
            $subject->teachers()->detach();
            $subject->delete();
            DB::commit();
            return redirect()->route('admin.subjects.index')->with('success', 'Mata pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}