<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom; // Assuming your class model is named ClassModel
use App\Models\Subject;
use App\Models\Grade;
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

        return view('roles.admin', compact(
            'totalStudents',
            'totalTeachers', 
            'totalclass_room',
            'totalSubjects',
            'classLabels',
            'studentCounts'
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
     * Get recent activities for dashboard
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Recent students added
        $recentGrades = Grade::with(['student', 'assignment.subject'])
            ->latest()
            ->limit(2)
            ->get();

        foreach ($recentGrades as $grade) {
            $activities[] = [
                'type' => 'grade_added', 
                'message' => "Nilai {$grade->assignment->subject->name} untuk {$grade->student->name} telah diinput",
                'time' => $grade->created_at->diffForHumans(),
                'icon_color' => 'lime-accent'
            ];
        }

        // Recent grades added (if you have timestamps)
        $recentGrades = Grade::with(['student', 'subject'])
            ->latest()
            ->limit(2)
            ->get();

        foreach ($recentGrades as $grade) {
            $activities[] = [
                'type' => 'grade_added', 
                'message' => "Nilai {$grade->subject->name} untuk {$grade->student->name} telah diinput",
                'time' => $grade->created_at->diffForHumans(),
                'icon_color' => 'lime-accent'
            ];
        }

        // Sort by time and limit to 5 most recent
        return collect($activities)->sortByDesc('time')->take(5)->values();
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