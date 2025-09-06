<?php

namespace Tests\Feature\Student;

use App\Models\Grade;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentGradeTest extends TestCase
{
    use RefreshDatabase;

    protected Student $student;
    protected Grade $grade;
    protected Semester $semester;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat siswa dan log in
        $this->student = Student::factory()->create();
        $this->actingAs($this->student->user);

        // Buat semester aktif
        $this->semester = Semester::factory()->create(['is_active' => true]);

        // Buat satu data nilai untuk siswa ini di semester aktif
        $this->grade = Grade::factory()->create([
            'student_id' => $this->student->id,
            'semester_id' => $this->semester->id,
            'score' => 95,
        ]);
    }

    public function test_student_can_view_their_grades_page(): void
    {
        $this->get(route('student.grades.index'))
            ->assertStatus(200)
            ->assertSee('Rapor Online') // Pastikan teks ini ada di view rapor siswa
            ->assertSee($this->grade->subject->name) // Pastikan nama mata pelajaran dari nilai tersebut muncul
            ->assertSee('95'); // Pastikan skornya muncul
    }
}