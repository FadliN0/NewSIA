<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Menampilkan halaman untuk memilih kelas dan mata pelajaran
     * untuk mengelola absensi.
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;

        // Eager load relasi untuk mendapatkan nama kelas dan mapel
        $assignments = $teacher->assignments()->with(['classRoom', 'subject'])->get();
        
        // Kelompokkan berdasarkan kelas untuk tampilan yang lebih rapi
        $classAssignments = $assignments->groupBy('classRoom.name');

        return view('teacher.attendance.index', compact('classAssignments'));
    }
}