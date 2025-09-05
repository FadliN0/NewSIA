<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Attendance ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $student = Auth::user()->student;
        $semesters = Semester::orderBy('school_year', 'desc')->get();
        $selectedSemesterId = $request->query('semester')
            ? (int) $request->query('semester')
            : (Semester::where('is_active', true)->first()->id ?? null);
        if (!$selectedSemesterId) {
            return view('student.grades.index', [
                'gradesBySubject' => collect(),
                'semesters' => $semesters,
                'selectedSemesterId' => null,
            ]);
        }
        
        $grades = Grade::where('student_id', $student->id)
            ->where('semester_id', $selectedSemesterId)
            ->with(['subject'])
            ->get();
        
        $attendances = Attendance::where('student_id', $student->id)
            ->where('semester_id', $selectedSemesterId)
            ->with(['subject'])
            ->get();
        
        $gradesBySubject = $grades->groupBy('subject.name')->map(function ($subjectGrades) use ($attendances) {
            $tugas = $subjectGrades->where('grade_type', 'Tugas')->avg('score') ?? 0;
            $uts = $subjectGrades->where('grade_type', 'UTS')->first()->score ?? 0;
            $uas = $subjectGrades->where('grade_type', 'UAS')->first()->score ?? 0;

            // Logika baru untuk kehadiran
            $subjectAttendances = $attendances->where('subject.name', $subjectGrades->first()->subject->name);
            $totalMeetings = $subjectAttendances->count();
            $presentCount = $subjectAttendances->where('status', 'Hadir')->count();
            $attendanceScore = $totalMeetings > 0 ? ($presentCount / $totalMeetings) * 100 : 0;
            
            // Hitung nilai akhir dengan bobot 40% Tugas, 30% UTS, 30% UAS, 10% Kehadiran
            $finalGrade = ($tugas * 0.4) + ($uts * 0.3) + ($uas * 0.3) + ($attendanceScore * 0.1);

            return [
                'tugas' => $tugas,
                'uts' => $uts,
                'uas' => $uas,
                'attendance' => $attendanceScore,
                'final_grade' => number_format($finalGrade, 2),
            ];
        });

        $averageFinalGrade = $gradesBySubject->avg('final_grade');

        return view('student.grades.index', compact('gradesBySubject', 'semesters', 'selectedSemesterId', 'averageFinalGrade'));
    }
}
