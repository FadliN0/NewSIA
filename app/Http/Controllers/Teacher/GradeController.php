<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\TeacherSubject;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * LANGKAH 1: Menampilkan halaman untuk memilih kelas dan mata pelajaran.
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $assignments = $teacher->assignments()
            ->whereNotNull('class_room_id')
            ->with(['classRoom', 'subject'])
            ->get();
        
        $classAssignments = $assignments->groupBy('classRoom.name');

        return view('teacher.grades.index', compact('classAssignments'));
    }

    /**
     * LANGKAH 2: Menampilkan form untuk menginput nilai.
     */
    public function create(Request $request)
    {
        $assignmentId = $request->query('assignment_id');
        $assignment = TeacherSubject::with(['classRoom.students', 'subject'])->find($assignmentId);
        $activeSemester = Semester::where('is_active', true)->first();

        if (!$activeSemester) {
            return redirect()->route('teacher.grades.index')->with('error', 'Tidak ada semester yang aktif. Tidak dapat menginput nilai.');
        }

        if (!$assignment || $assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke sumber daya ini.');
        }

        $students = $assignment->classRoom->students()->orderBy('full_name')->get();

        // Ambil nilai yang sudah ada untuk siswa di kelas ini agar bisa ditampilkan di form
        $existingGrades = Grade::where('subject_id', $assignment->subject_id)
            ->where('semester_id', $activeSemester->id)
            ->whereIn('student_id', $students->pluck('id'))
            ->get()
            ->groupBy('student_id');

        return view('teacher.grades.create', compact('assignment', 'students', 'activeSemester', 'existingGrades'));
    }

    /**
     * LANGKAH 3: Menyimpan data nilai yang diinput dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi data dasar
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:teacher_subjects,id',
            'grades' => 'required|array',
            // Validasi setiap nilai yang diinput
            'grades.*.Tugas' => 'nullable|numeric|min:0|max:100',
            'grades.*.UTS' => 'nullable|numeric|min:0|max:100',
            'grades.*.UAS' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Ambil data penting
        $assignment = TeacherSubject::find($request->assignment_id);
        $activeSemester = Semester::where('is_active', true)->first();

        // Cek otorisasi
        if ($assignment->teacher_id !== Auth::user()->teacher->id) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester aktif.');
        }

        // 3. Looping untuk menyimpan setiap nilai
        foreach ($request->grades as $studentId => $gradeTypes) {
            foreach ($gradeTypes as $gradeType => $score) {
                // Hanya simpan jika ada nilainya (tidak kosong)
                if (!is_null($score)) {
                    Grade::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'subject_id' => $assignment->subject_id,
                            'semester_id' => $activeSemester->id,
                            'grade_type' => $gradeType,
                        ],
                        [
                            'score' => $score,
                        ]
                    );
                }
            }
        }

        // 4. Kembali ke halaman pemilihan dengan pesan sukses
        return redirect()->route('teacher.grades.index')
                         ->with('success', 'Nilai untuk kelas ' . $assignment->classRoom->name . ' pada mata pelajaran ' . $assignment->subject->name . ' berhasil disimpan!');
    }
}