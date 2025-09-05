<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\TeacherSubject;
use App\Models\Semester;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class GradeController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $activeSemester = Semester::where('is_active', true)->first();
    
        // Ambil semua kelas dan mata pelajaran yang diampu guru di semester aktif
        $teacherSubjects = TeacherSubject::where('teacher_id', $teacher->id)
            ->where('semester_id', optional($activeSemester)->id)
            ->with(['classRoom.students.grades' => function ($query) use ($activeSemester) {
                // Eager loading nilai siswa untuk semester aktif
                $query->where('semester_id', optional($activeSemester)->id)
                      ->with('subject');
            }, 'classRoom', 'subject'])
            ->get();
    
        $gradesData = collect();
    
        // Memproses data untuk rekapitulasi nilai per siswa
        foreach ($teacherSubjects as $teacherSubject) {
            $classStudents = $teacherSubject->classRoom->students;
    
            $studentsData = $classStudents->map(function ($student) use ($teacherSubject) {
                $grades = $student->grades->where('subject_id', $teacherSubject->subject_id);
    
                $averageTaskGrade = $grades->where('grade_type', 'Tugas')->avg('score') ?? 0;
                $utsGrade = $grades->where('grade_type', 'UTS')->first()->score ?? 'N/A';
                $uasGrade = $grades->where('grade_type', 'UAS')->first()->score ?? 'N/A';
    
                return [
                    'student_id' => $student->id,
                    'full_name' => $student->full_name,
                    'average_task_grade' => number_format($averageTaskGrade, 2),
                    'uts_grade' => $utsGrade,
                    'uas_grade' => $uasGrade,
                ];
            });
    
            $gradesData->push([
                'class_room_id' => $teacherSubject->classRoom->id,
                'class_room_name' => $teacherSubject->classRoom->name,
                'subject_id' => $teacherSubject->subject->id,
                'subject_name' => $teacherSubject->subject->name,
                'teacher_subject_id' => $teacherSubject->id,
                'students' => $studentsData,
            ]);
        }

        $gradesData = $gradesData->sortBy('class_room_name');
    
        return view('teacher.grades.index', compact('gradesData', 'activeSemester'));
    }

    // Metode create()
    public function create(Request $request)
    {
        $type = $request->query('type');
        $id = $request->query('id'); // teacher_subject_id
        $teacher = Auth::user()->teacher;
        $activeSemester = Semester::where('is_active', true)->first();

        if (!$activeSemester) {
            return redirect()->route('teacher.grades.index')->with('error', 'Tidak ada semester yang aktif. Tidak dapat menginput nilai.');
        }

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
            ->keyBy('student_id');

        $viewTitle = 'Input Nilai ' . $type . ': ' . $teacherSubject->subject->name . ' - Kelas ' . $teacherSubject->classRoom->name;
        
        return view('teacher.grades.create', compact('students', 'existingGrades', 'viewTitle', 'type', 'id'));
    }

    // Metode store()
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:teacher_subjects,id',
            'type' => ['required', Rule::in(['UTS', 'UAS'])],
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:0|max:100',
        ]);
        
        $teacherSubject = TeacherSubject::find($request->id);
        $activeSemester = Semester::where('is_active', true)->first();
        
        if (!$teacherSubject || $teacherSubject->teacher_id !== Auth::user()->teacher->id) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester aktif.');
        }

        foreach ($request->grades as $studentId => $score) {
            if (!is_null($score)) {
                Grade::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'subject_id' => $teacherSubject->subject_id,
                        'semester_id' => $activeSemester->id,
                        'grade_type' => $request->type,
                    ],
                    ['score' => $score]
                );
            }
        }

        return redirect()->route('teacher.grades.index')
                         ->with('success', 'Nilai ' . $request->type . ' untuk kelas ' . $teacherSubject->classRoom->name . ' pada mata pelajaran ' . $teacherSubject->subject->name . ' berhasil disimpan!');
    }
}