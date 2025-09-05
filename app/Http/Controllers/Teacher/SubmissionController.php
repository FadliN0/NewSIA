<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Submission;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    /**
     * Menampilkan semua unggahan untuk tugas tertentu.
     */
    public function show(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        // Ambil data unggahan dari siswa di kelas ini
        $submissions = Submission::where('assignment_id', $assignment->id)
            ->with('student.user')
            ->get();
        
        // Ambil nilai yang sudah ada untuk tugas ini
        $existingGrades = Grade::where('assignment_id', $assignment->id)->get()->keyBy('student_id');

        return view('teacher.assignments.submission', compact('assignment', 'submissions', 'existingGrades'));
    }

    /**
     * Menyimpan nilai tugas dari halaman unggahan.
     */
    public function storeGrades(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        $request->validate([
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $activeSemester = Semester::where('is_active', true)->first();
        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester aktif.');
        }

        foreach ($request->grades as $studentId => $score) {
            if (!is_null($score)) {
                Grade::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'assignment_id' => $assignment->id,
                        'subject_id' => $assignment->subject_id,
                        'semester_id' => $activeSemester->id,
                        'grade_type' => 'Tugas',
                    ],
                    ['score' => $score]
                );
            }
        }

        return redirect()->route('teacher.assignments.index')->with('success', 'Nilai tugas berhasil disimpan!');
    }
}