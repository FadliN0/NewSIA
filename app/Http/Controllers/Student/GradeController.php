<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $student = Auth::user()->student;
        $semesters = Semester::orderBy('school_year', 'desc')->get();
        $selectedSemesterId = $request->query('semester') ?? ($semesters->first()->id ?? null);
        
        $grades = Grade::where('student_id', $student->id)
            ->where('semester_id', $selectedSemesterId)
            ->with(['subject'])
            ->get();
        
        $gradesBySubject = $grades->groupBy('subject.name')->map(function ($subjectGrades) {
            $tugas = $subjectGrades->where('grade_type', 'Tugas')->avg('score') ?? 0;
            $uts = $subjectGrades->where('grade_type', 'UTS')->first()->score ?? 0;
            $uas = $subjectGrades->where('grade_type', 'UAS')->first()->score ?? 0;
            
            // Hitung nilai akhir dengan bobot 40% Tugas, 30% UTS, 30% UAS
            $finalGrade = ($tugas * 0.4) + ($uts * 0.3) + ($uas * 0.3);

            return [
                'tugas' => $tugas,
                'uts' => $uts,
                'uas' => $uas,
                'final_grade' => number_format($finalGrade, 2),
            ];
        });

        return view('student.grades.index', compact('gradesBySubject', 'semesters', 'selectedSemesterId'));
    }
}
