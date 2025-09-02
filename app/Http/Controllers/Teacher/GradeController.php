<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\TeacherSubject;
use App\Models\Semester;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Menampilkan halaman untuk memilih jenis input nilai (Tugas, UTS, UAS).
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $teacherSubjects = $teacher->teacherSubjects()
            ->with(['classRoom', 'subject'])
            ->get()
            ->groupBy('classRoom.name');

        return view('teacher.grades.index', compact('teacherSubjects'));
    }

    /**
     * Menampilkan form input nilai berdasarkan jenis (tugas, uts, uas) dan ID.
     */
    public function create(Request $request)
    {
        $type = $request->query('type');
        $id = $request->query('id');
        $teacher = Auth::user()->teacher;
        $activeSemester = Semester::where('is_active', true)->first();

        if (!$activeSemester) {
            return redirect()->route('teacher.grades.index')->with('error', 'Tidak ada semester yang aktif. Tidak dapat menginput nilai.');
        }

        // Tentukan data yang akan ditampilkan berdasarkan tipe
        if ($type === 'tugas') {
            $assignment = Assignment::with(['classRoom.students', 'subject'])->find($id);

            if (!$assignment || $assignment->teacher_id !== $teacher->id) {
                abort(403, 'Anda tidak memiliki akses ke sumber daya ini.');
            }

            $students = $assignment->classRoom->students()->orderBy('full_name')->get();
            $existingGrades = Grade::where('assignment_id', $assignment->id)->get()->groupBy('student_id');
            $viewTitle = 'Input Nilai Tugas: ' . $assignment->title . ' - Kelas ' . $assignment->classRoom->name;

        } elseif (in_array($type, ['UTS', 'UAS'])) {
            $teacherSubject = TeacherSubject::with(['classRoom.students', 'subject'])->find($id);

            if (!$teacherSubject || $teacherSubject->teacher_id !== $teacher->id) {
                abort(403, 'Anda tidak memiliki akses ke sumber daya ini.');
            }

            $students = $teacherSubject->classRoom->students()->orderBy('full_name')->get();
            $existingGrades = Grade::where('subject_id', $teacherSubject->subject_id)
                ->where('semester_id', $activeSemester->id)
                ->where('grade_type', $type)
                ->whereIn('student_id', $students->pluck('id'))
                ->get()
                ->groupBy('student_id');
            $viewTitle = 'Input Nilai ' . $type . ': ' . $teacherSubject->subject->name . ' - Kelas ' . $teacherSubject->classRoom->name;
        
        } else {
            return redirect()->route('teacher.grades.index')->with('error', 'Tipe nilai tidak valid.');
        }

        return view('teacher.grades.create', compact('students', 'activeSemester', 'existingGrades', 'viewTitle', 'type', 'id'));
    }

    /**
     * Menyimpan data nilai yang diinput dari form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'type' => ['required', Rule::in(['tugas', 'UTS', 'UAS'])],
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $activeSemester = Semester::where('is_active', true)->first();
        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester aktif.');
        }

        // Tentukan data yang relevan berdasarkan tipe
        if ($request->type === 'tugas') {
            $assignment = Assignment::with(['classRoom', 'subject'])->find($request->id);
            if (!$assignment || $assignment->teacher_id !== Auth::user()->teacher->id) {
                abort(403, 'Anda tidak memiliki hak akses.');
            }
            $subjectId = $assignment->subject_id;
            $classRoomId = $assignment->classRoom->id;
        } else {
            $teacherSubject = TeacherSubject::with(['classRoom', 'subject'])->find($request->id);
            if (!$teacherSubject || $teacherSubject->teacher_id !== Auth::user()->teacher->id) {
                abort(403, 'Anda tidak memiliki hak akses.');
            }
            $subjectId = $teacherSubject->subject_id;
            $classRoomId = $teacherSubject->classRoom->id;
        }

        foreach ($request->grades as $studentId => $score) {
            if (!is_null($score)) {
                $data = [
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'semester_id' => $activeSemester->id,
                    'grade_type' => $request->type === 'tugas' ? 'Tugas' : $request->type, // Ubah tipe menjadi 'Tugas' jika dari alur tugas
                    'score' => $score,
                ];

                if ($request->type === 'tugas') {
                    $data['assignment_id'] = $request->id;
                }
                
                Grade::updateOrCreate(
                    array_filter([
                        'student_id' => $studentId,
                        'subject_id' => $subjectId,
                        'semester_id' => $activeSemester->id,
                        'grade_type' => $request->type === 'tugas' ? 'Tugas' : $request->type,
                        'assignment_id' => $request->type === 'tugas' ? $request->id : null,
                    ]),
                    ['score' => $score]
                );
            }
        }

        $message = 'Nilai berhasil disimpan!';
        return redirect()->route('teacher.grades.index')->with('success', $message);
    }
}