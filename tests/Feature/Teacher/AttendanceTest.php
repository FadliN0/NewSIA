<?php

namespace Tests\Feature\Teacher;

use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherAttendanceTest extends TestCase
{
    use RefreshDatabase;

    protected Teacher $teacher;
    protected TeacherSubject $assignmentScope;
    protected Student $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacher = Teacher::factory()->create();
        $this->actingAs($this->teacher->user);

        // Pastikan ada semester aktif karena controller memerlukannya
        $activeSemester = Semester::factory()->create(['is_active' => true]);

        $this->assignmentScope = TeacherSubject::factory()->create([
            'teacher_id' => $this->teacher->id,
            'semester_id' => $activeSemester->id,
        ]);

        $this->student = Student::factory()->create([
            'class_room_id' => $this->assignmentScope->class_room_id,
        ]);
    }

    public function test_teacher_can_view_attendance_page(): void
    {
        $this->get(route('teacher.attendances.index'))
            ->assertStatus(200)
            ->assertSee('Kelola Absensi');
    }

    public function test_teacher_can_store_attendances(): void
    {
        // --- INI BAGIAN YANG DIPERBAIKI ---
        $attendanceData = [
            'assignment_id' => $this->assignmentScope->id, // Menggunakan 'assignment_id'
            'attendance_date' => now()->format('Y-m-d'), // Menggunakan 'attendance_date'
            'attendances' => [
                $this->student->id => 'Hadir', // Menggunakan status yang valid
            ],
        ];

        $this->post(route('teacher.attendances.store'), $attendanceData)
            ->assertRedirect()
            ->assertSessionHas('success');

        // Memeriksa database dengan struktur kolom yang benar
        $this->assertDatabaseHas('attendances', [
            'student_id' => $this->student->id,
            'subject_id' => $this->assignmentScope->subject_id,
            'status' => 'Hadir',
        ]);
    }
}