<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * LANGKAH 1: Menampilkan halaman untuk memilih kelas dan mata pelajaran.
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;

        // Ambil semua penugasan yang sudah memiliki kelas
        $assignments = $teacher->assignments()
            ->whereNotNull('class_room_id') // Hanya ambil yang sudah punya kelas
            ->with(['classRoom', 'subject'])
            ->get();
        
        // Kelompokkan berdasarkan nama kelas untuk tampilan yang rapi
        $classAssignments = $assignments->groupBy('classRoom.name');

        return view('teacher.attendances.index', compact('classAssignments'));
    }

    /**
     * LANGKAH 2: Menampilkan form untuk menginput absensi.
     */
    public function create(Request $request)
    {
        $assignmentId = $request->query('assignment_id');
        $assignment = TeacherSubject::with(['classRoom.students', 'subject'])->find($assignmentId);

        // Validasi: pastikan penugasan ada dan milik guru yang login
        if (!$assignment || $assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke sumber daya ini.');
        }

        $students = $assignment->classRoom->students()->orderBy('full_name')->get();
        $today = now()->format('Y-m-d');

        return view('teacher.attendances.create', compact('assignment', 'students', 'today'));
    }

    /**
     * Menyimpan data absensi yang baru diinput.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:teacher_subjects,id',
            'attendance_date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*' => 'required|in:Hadir,Izin,Sakit,Alfa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // --- PERBAIKAN LOGIKA DIMULAI DI SINI ---

        // 1. Cari semester yang sedang aktif
        $activeSemester = \App\Models\Semester::where('is_active', true)->first();

        // 2. Jika tidak ada semester aktif, kembali dengan pesan error
        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester yang aktif saat ini. Harap hubungi admin.');
        }

        $assignment = \App\Models\TeacherSubject::find($request->assignment_id);
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        foreach ($request->attendances as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject_id' => $assignment->subject_id,
                    'semester_id' => $activeSemester->id, // <-- Gunakan ID semester aktif
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('teacher.attendances.index')
                         ->with('success', 'Absensi untuk kelas ' . $assignment->classRoom->name . ' pada mata pelajaran ' . $assignment->subject->name . ' berhasil disimpan!');
    }
}