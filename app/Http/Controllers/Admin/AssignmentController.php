<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassRoom;
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
     * Menampilkan form untuk membuat penugasan baru.
     */
    public function create()
    {
        // Ambil guru yang sudah punya mata pelajaran, tapi belum punya kelas
        $unassignedTeachers = TeacherSubject::whereNull('class_room_id')->with(['teacher', 'subject'])->get();
        $classes = ClassRoom::orderBy('name')->get();

        return view('admin.assignments.create', compact('unassignedTeachers', 'classes'));
    }

    /**
     * Menyimpan penugasan (menambahkan kelas ke penugasan yang ada).
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_subject_id' => 'required|exists:teacher_subjects,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        // Cari penugasan yang dipilih
        $assignment = TeacherSubject::find($request->teacher_subject_id);

        // Cek apakah sudah ada penugasan yang sama persis
        $exists = TeacherSubject::where('teacher_id', $assignment->teacher_id)
                                ->where('subject_id', $assignment->subject_id)
                                ->where('class_room_id', $request->class_room_id)
                                ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Guru ini sudah ditugaskan mengajar mata pelajaran tersebut di kelas yang sama.');
        }

        // Update penugasan yang lama dengan class_room_id
        // ATAU buat baris baru jika ingin guru mengajar mapel yang sama di banyak kelas
        $assignment->update([
            'teacher_id' => $assignment->teacher_id,
            'subject_id' => $assignment->subject_id,
            'class_room_id' => $request->class_room_id,
        ]);
        
        // Hapus penugasan lama yang class_room_id-nya null (opsional, tergantung logika bisnis)
        // $assignment->delete();

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