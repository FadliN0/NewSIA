<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard guru.
     */
    public function index()
    {
        // Ambil guru yang sedang login
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            // Jika akun user tidak terhubung dengan data guru, kembali dengan error
            Auth::logout();
            return redirect('/login')->with('error', 'Akun Anda tidak terhubung dengan data guru.');
        }

        // Ambil data mata pelajaran yang diajar oleh guru ini
        // Eager load relasi 'subjects' untuk efisiensi
        $teacher->load('subjects');
        $subjectsTaught = $teacher->subjects;
        
        // Di masa depan, kita akan mengambil data kelas dari tabel teacher_subjects
        // Untuk sekarang, kita tampilkan dulu mata pelajarannya

        return view('roles.teacher', compact('teacher', 'subjectsTaught'));
    }
}