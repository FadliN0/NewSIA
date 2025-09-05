<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassRoom;
use App\Models\Semester; // 🔹 tambahkan model Semester
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Menampilkan daftar semua penugasan mengajar.
     */
    public function index()
    {
        $assignments = TeacherSubject::with(['teacher', 'subject', 'classRoom'])->latest()->paginate(15);
        return view('admin.assignments.index', compact('assignments'));
    }

    /**
     * Menampilkan form untuk membuat penugasan baru dengan 3 dropdown.
     */
    public function create()
    {
        $teachers = Teacher::orderBy('full_name')->get();
        $subjects = Subject::orderBy('name')->get();
        $classes = ClassRoom::orderBy('name')->get();

        return view('admin.assignments.create', compact('teachers', 'subjects', 'classes'));
    }

    /**
     * Menyimpan penugasan baru dengan membuat baris baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        // 🔹 Ambil semester aktif
        $activeSemester = Semester::where('is_active', true)->first();
        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester aktif. Tidak dapat membuat penugasan.');
        }

        // Cek apakah penugasan yang sama persis sudah ada untuk mencegah duplikasi
        $exists = TeacherSubject::where('teacher_id', $request->teacher_id)
                                ->where('subject_id', $request->subject_id)
                                ->where('class_room_id', $request->class_room_id)
                                ->where('semester_id', $activeSemester->id) // 🔹 filter semester juga
                                ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Guru ini sudah ditugaskan mengajar mata pelajaran tersebut di kelas yang sama untuk semester aktif.');
        }

        // Selalu buat baris data baru, ini adalah logika yang benar
        TeacherSubject::create([
            'teacher_id'    => $request->teacher_id,
            'subject_id'    => $request->subject_id,
            'class_room_id' => $request->class_room_id,
            'semester_id'   => $activeSemester->id, // 🔹 simpan semester aktif
        ]);

        return redirect()->route('admin.assignments.index')->with('success', 'Penugasan berhasil dibuat.');
    }

    /**
     * Menghapus penugasan mengajar.
     */
    public function destroy(TeacherSubject $assignment)
    {
        $assignment->delete();
        return redirect()->route('admin.assignments.index')->with('success', 'Penugasan berhasil dihapus.');
    }
}
