<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $activeSemester = Semester::where('is_active', true)->first();
        
        // Ambil data statistik dari model yang sudah diperbaiki
        $subjects = $student->classRoom->subjects ?? collect();
        $subjectCount = $subjects->count();

        // Rata-rata nilai
        $averageGrade = Grade::where('student_id', $student->id)
            ->where('semester_id', optional($activeSemester)->id)
            ->avg('score');

        // Rekapitulasi kehadiran
        $totalAttendance = Attendance::where('student_id', $student->id)
            ->where('semester_id', optional($activeSemester)->id)
            ->count();
        $presentCount = Attendance::where('student_id', $student->id)
            ->where('semester_id', optional($activeSemester)->id)
            ->where('status', 'Hadir')
            ->count();
        $attendancePercentage = $totalAttendance > 0 ? ($presentCount / $totalAttendance) * 100 : 0;
        
        // Data untuk grafik
        $subjectGrades = Grade::select('subject_id', DB::raw('avg(score) as average_score'))
            ->where('student_id', $student->id)
            ->where('semester_id', optional($activeSemester)->id)
            ->groupBy('subject_id')
            ->with('subject')
            ->get();
            
        // Ambil tugas yang akan datang
        $upcomingAssignments = Assignment::where('class_room_id', $student->class_room_id)
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->take(5)
            ->with(['subject'])
            ->get();
        
        return view('roles.student', compact(
            'student',
            'subjectCount',
            'averageGrade',
            'attendancePercentage',
            'upcomingAssignments',
            'subjectGrades'
        ));
    }
}