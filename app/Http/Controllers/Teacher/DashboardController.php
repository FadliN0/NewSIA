<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            Auth::logout();
            return redirect('/login')->with('error', 'Akun Anda tidak terhubung dengan data guru.');
        }

        // 1. Ambil semua data penugasan dari database
        $allAssignments = $teacher->assignments()->with(['classRoom.students', 'subject'])->get();

        // 2. INI PERBAIKANNYA: Saring dan buang data penugasan yang kelasnya sudah tidak ada
        $assignments = $allAssignments->filter(function ($assignment) {
            return $assignment->classRoom !== null;
        });
        
        // 3. Sekarang, semua proses di bawah ini aman dari error null
        $classAssignments = $assignments->groupBy('classRoom.name');

        // Hitung data untuk kartu statistik
        $totalClasses = $assignments->pluck('class_room_id')->unique()->count();
        $totalSubjects = $assignments->pluck('subject_id')->unique()->count();
        
        $totalStudents = $assignments->flatMap(function ($assignment) {
            // Kode ini sekarang aman karena kita sudah membuang data yang classRoom-nya null
            return $assignment->classRoom->students->pluck('id');
        })->unique()->count();


        return view('roles.teacher', compact(
            'teacher', 
            'classAssignments',
            'totalClasses',
            'totalSubjects',
            'totalStudents'
        ));
    }
}