<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $assignments = Assignment::where('class_room_id', $student->class_room_id)
            ->with(['teacher', 'subject', 'submissions' => function ($query) use ($student) {
                $query->where('student_id', $student->id);
            }])
            ->latest('due_date')
            ->get();
        
        return view('student.assignments.index', compact('assignments'));
    }

    public function show(Assignment $assignment)
    {
        $student = Auth::user()->student;

        if ($assignment->class_room_id !== $student->class_room_id) {
            abort(403);
        }

        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, Assignment $assignment)
    {
        $student = Auth::user()->student;

        if ($assignment->class_room_id !== $student->class_room_id) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
        ]);
        
        // Hapus unggahan lama jika ada
        $oldSubmission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        if ($oldSubmission) {
            Storage::disk('public')->delete($oldSubmission->file_path);
            $oldSubmission->delete();
        }

        $file = $request->file('file');
        $path = $file->store('submissions', 'public');

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('student.assignments.show', $assignment)->with('success', 'Tugas berhasil diunggah!');
    }
}
