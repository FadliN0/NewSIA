<?php

namespace Tests\Feature\Teacher;

use App\Models\Grade;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherGradeTest extends TestCase
{
    use RefreshDatabase;

    protected Teacher $teacher;
    protected TeacherSubject $assignmentScope;
    protected Student $student;
    protected Semester $activeSemester;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacher = Teacher::factory()->create();
        $this->actingAs($this->teacher->user);

        // Pastikan ada semester aktif karena controller memerlukannya
        $this->activeSemester = Semester::factory()->create(['is_active' => true]);

        $this->assignmentScope = TeacherSubject::factory()->create([
            'teacher_id' => $this->teacher->id,
            'semester_id' => $this->activeSemester->id,
        ]);

        $this->student = Student::factory()->create([
            'class_room_id' => $this->assignmentScope->class_room_id,
        ]);
    }

    public function test_teacher_can_view_grade_page(): void
    {
        $this->get(route('teacher.grades.index'))
            ->assertStatus(200)
            ->assertSee('Rekap Nilai Siswa'); // Menyesuaikan dengan teks yang kemungkinan ada di view
    }

    public function test_teacher_can_store_grades_for_student(): void
    {
        $gradeData = [
            'id' => $this->assignmentScope->id,
            'type' => 'UTS', // Mengirim tipe yang valid
            'grades' => [
                $this->student->id => 95,
            ],
        ];

        $this->post(route('teacher.grades.store'), $gradeData)
            ->assertRedirect()
            ->assertSessionHas('success');

        // --- BAGIAN INI DIPERBAIKI ---
        // Memeriksa database dengan struktur kolom yang benar
        $this->assertDatabaseHas('grades', [
            'student_id' => $this->student->id,
            'subject_id' => $this->assignmentScope->subject_id,
            'semester_id' => $this->activeSemester->id,
            'grade_type' => 'UTS',
            'score' => 95,
        ]);
    }
}
