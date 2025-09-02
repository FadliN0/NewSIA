<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $assignments = Assignment::where('teacher_id', $teacher->id)
            ->with(['classRoom', 'subject'])
            ->latest()
            ->paginate(10);

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $teacher = Auth::user()->teacher;
        $classAssignments = $teacher->assignments()->whereNotNull('class_room_id')->with(['classRoom', 'subject'])->get();
        
        return view('teacher.assignments.create', compact('classAssignments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_subject_id' => 'required|exists:teacher_subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date_format:Y-m-d\TH:i', // Format HTML5 datetime-local
        ]);

        $assignment = TeacherSubject::find($request->teacher_subject_id);

        Assignment::create([
            'teacher_id' => Auth::user()->teacher->id,
            'class_room_id' => $assignment->class_room_id,
            'subject_id' => $assignment->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil dibuat.');
    }

    public function edit(Assignment $assignment)
    {
        // Otorisasi: pastikan guru hanya bisa mengedit tugas miliknya
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        $teacher = Auth::user()->teacher;
        $classAssignments = $teacher->assignments()->whereNotNull('class_room_id')->with(['classRoom', 'subject'])->get();

        return view('teacher.assignments.edit', compact('assignment', 'classAssignments'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }
        
        $request->validate([
            'teacher_subject_id' => 'required|exists:teacher_subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $newAssignmentInfo = TeacherSubject::find($request->teacher_subject_id);

        $assignment->update([
            'class_room_id' => $newAssignmentInfo->class_room_id,
            'subject_id' => $newAssignmentInfo->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        $assignment->delete();
        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil dihapus.');
    }
}