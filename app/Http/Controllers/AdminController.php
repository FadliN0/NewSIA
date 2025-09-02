<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom; 
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        // Get basic counts
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalclass_room = ClassRoom::count();
        $totalSubjects = Subject::count();

        // Data untuk chart "Jumlah Siswa per Kelas"
        $classes = ClassRoom::withCount('students')->orderBy('name')->get();
        $classLabels = $classes->pluck('name'); // ['10A', '10B', '11A', ...]
        $studentCounts = $classes->pluck('students_count'); // [30, 28, 32, ...]

        // --- DATA BARU UNTUK CHART PERFORMA AKADEMIK ---
        $academicPerformance = Grade::join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->select('subjects.name as subject_name', DB::raw('AVG(grades.score) as average_score'))
            ->groupBy('subjects.name')
            ->orderBy('subjects.name')
            ->get();
        $subjectLabels = $academicPerformance->pluck('subject_name');
        $averageScores = $academicPerformance->pluck('average_score')->map(fn($score) => round($score, 2));

        // --- DATA BARU UNTUK CHART TINGKAT KEHADIRAN ---
        $attendanceData = Attendance::join('subjects', 'attendances.subject_id', '=', 'subjects.id')
            ->select(
                'subjects.name as subject_name',
                DB::raw('SUM(CASE WHEN attendances.status = "Hadir" THEN 1 ELSE 0 END) as present_count'),
                DB::raw('COUNT(attendances.id) as total_count')
            )
            ->groupBy('subjects.name')->orderBy('subjects.name')->get();

        $attendanceLabels = $attendanceData->pluck('subject_name');
        $attendancePercentages = $attendanceData->map(function ($item) {
            return $item->total_count > 0 ? round(($item->present_count / $item->total_count) * 100, 2) : 0;
        });

        $recentStudents = Student::with('classRoom')->latest()->take(5)->get();
        
        // Kirim semua data ke view
        return view('roles.admin', compact(
            'totalStudents',
            'totalTeachers', 
            'totalclass_room',
            'totalSubjects',
            'classLabels',
            'studentCounts',
            'subjectLabels',
            'averageScores',
            'attendanceLabels',
            'attendancePercentages',
            'recentStudents'
        ));
    }

    /**
     * Get academic performance data for chart
     */
    private function getAcademicPerformanceData()
    {
        // Get average grades per class
        $performanceData = DB::table('grades')
            ->join('students', 'grades.student_id', '=', 'students.id')
            ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
            ->select('class_rooms.name as class_name', DB::raw('AVG(grades.score) as average_grade'))
            ->whereNotNull('grades.score')
            ->groupBy('class_rooms.id', 'class_rooms.name')
            ->orderBy('class_rooms.name')
            ->get();

        return [
            'labels' => $performanceData->pluck('class_name')->toArray(),
            'data' => $performanceData->pluck('average_grade')->map(function($grade) {
                return round($grade, 1);
            })->toArray()
        ];
    }

    /**
     * Academic Reports
     */
    public function academicReports()
    {
        // Get comprehensive academic data
        $classPerformance = DB::table('grades')
            ->join('students', 'grades.student_id', '=', 'students.id')
            ->join('class_room', 'students.class_room_id', '=', 'class_room.id')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->select(
                'class_room.name as class_name',
                'subjects.name as subject_name',
                DB::raw('AVG(grades.score) as average_grade'),
                DB::raw('COUNT(grades.id) as student_count')
            )
            ->whereNotNull('grades.score')
            ->groupBy('class_room.id', 'class_room.name', 'subjects.id', 'subjects.name')
            ->orderBy('class_room.name')
            ->orderBy('subjects.name')
            ->get();

        return view('admin.reports.academic', compact('classPerformance'));
    }

    /**
     * Attendance Reports  
     */
    public function attendanceReports()
    {
        // Get attendance statistics
        $attendanceStats = DB::table('attendances')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->join('class_room', 'students.class_id', '=', 'class_room.id')
            ->select(
                'class_room.name as class_name',
                DB::raw('COUNT(CASE WHEN attendances.status = "present" THEN 1 END) as present_count'),
                DB::raw('COUNT(CASE WHEN attendances.status = "absent" THEN 1 END) as absent_count'),
                DB::raw('COUNT(CASE WHEN attendances.status = "late" THEN 1 END) as late_count'),
                DB::raw('COUNT(attendances.id) as total_records')
            )
            ->groupBy('class_room.id', 'class_room.name')
            ->orderBy('class_room.name')
            ->get();

        return view('admin.reports.attendance', compact('attendanceStats'));
    }

    /**
     * Export Academic Report to PDF/Excel
     */
    public function exportAcademicReport(Request $request)
    {
        $format = $request->get('format', 'pdf'); // pdf or excel
        
        // Get the data
        $classPerformance = DB::table('grades')
            ->join('students', 'grades.student_id', '=', 'students.id')
            ->join('class_room', 'students.class_id', '=', 'class_room.id')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->select(
                'class_room.name as class_name',
                'subjects.name as subject_name',
                DB::raw('AVG(grades.score) as average_grade'),
                DB::raw('COUNT(grades.id) as student_count')
            )
            ->whereNotNull('grades.score')
            ->groupBy('class_room.id', 'class_room.name', 'subjects.id', 'subjects.name')
            ->orderBy('class_room.name')
            ->orderBy('subjects.name')
            ->get();

        if ($format === 'pdf') {
            // Return PDF download (you'll need to install a PDF package like dompdf)
            return view('admin.reports.academic-pdf', compact('classPerformance'));
        } else {
            // Return Excel download (you'll need to install maatwebsite/excel)
            // return Excel::download(new AcademicReportExport($classPerformance), 'academic-report.xlsx');
        }
    }
}