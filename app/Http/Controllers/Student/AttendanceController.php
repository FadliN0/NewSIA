<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $activeSemester = Semester::where('is_active', true)->first();

        // Ambil data absensi siswa
        $attendances = Attendance::where('student_id', $student->id)
            ->where('semester_id', $activeSemester->id)
            ->with('subject')
            ->latest('date')
            ->get();

        // Buat rekapitulasi per mata pelajaran
        $recap = $attendances->groupBy('subject.name')->map(function ($group) {
            return [
                'Hadir' => $group->where('status', 'Hadir')->count(),
                'Sakit' => $group->where('status', 'Sakit')->count(),
                'Izin' => $group->where('status', 'Izin')->count(),
                'Alpha' => $group->where('status', 'Alpha')->count(),
                'total' => $group->count(),
            ];
        });

        return view('student.attendances.index', compact('recap'));
    }
}
