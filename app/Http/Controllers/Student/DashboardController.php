<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $activeSemester = Semester::where('is_active', true)->first();
        
        // Jika tidak ada semester aktif, buat data kosong
        if (!$activeSemester) {
            return view('roles.student', [
                'student' => $student,
                'subjectCount' => 0,
                'averageGrade' => 0,
                'attendancePercentage' => 0,
                'upcomingAssignments' => collect(),
                'subjectGrades' => collect()
            ]);
        }

        // 1. Hitung jumlah mata pelajaran berdasarkan TeacherSubject
        $subjectCount = TeacherSubject::where('class_room_id', $student->class_room_id)
            ->where('semester_id', $activeSemester->id)
            ->distinct('subject_id')
            ->count();

        // 2. Rata-rata nilai - pastikan ada data
        $averageGrade = Grade::where('student_id', $student->id)
            ->where('semester_id', $activeSemester->id)
            ->avg('score') ?? 0;

        // 3. Rekapitulasi kehadiran - gunakan field yang benar
        $totalAttendance = Attendance::where('student_id', $student->id)
            ->where('semester_id', $activeSemester->id)
            ->count();
            
        $presentCount = Attendance::where('student_id', $student->id)
            ->where('semester_id', $activeSemester->id)
            ->where('status', 'Hadir')
            ->count();
            
        $attendancePercentage = $totalAttendance > 0 ? round(($presentCount / $totalAttendance) * 100, 1) : 0;
        
        // 4. Data untuk grafik nilai per mata pelajaran
        $subjectGrades = Grade::select('subject_id', DB::raw('avg(score) as average_score'))
            ->where('student_id', $student->id)
            ->where('semester_id', $activeSemester->id)
            ->groupBy('subject_id')
            ->with('subject')
            ->get();
            
        // 5. Ambil tugas yang akan datang (belum lewat deadline)
        $upcomingAssignments = Assignment::where('class_room_id', $student->class_room_id)
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->take(5)
            ->with(['subject', 'teacher'])
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