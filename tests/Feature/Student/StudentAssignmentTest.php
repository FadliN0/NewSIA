<?php

namespace Tests\Feature\Student;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\TeacherSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentAssignmentTest extends TestCase
{
    use RefreshDatabase;

    protected Student $student;
    protected Assignment $assignment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = Student::factory()->create();
        $this->actingAs($this->student->user);

        // Buat lingkup penugasan guru untuk kelas siswa
        $teacherSubject = TeacherSubject::factory()->create([
            'class_room_id' => $this->student->class_room_id,
        ]);

        // Buat tugas dengan mengisi kolom yang benar
        $this->assignment = Assignment::factory()->create([
            'teacher_id' => $teacherSubject->teacher_id,
            'subject_id' => $teacherSubject->subject_id,
            'class_room_id' => $teacherSubject->class_room_id,
        ]);
    }

    public function test_student_can_view_their_assignments_list(): void
    {
        $this->get(route('student.assignments.index'))
            ->assertStatus(200)
            ->assertSee('Daftar Tugas')
            ->assertSee($this->assignment->title);
    }

    public function test_student_can_view_assignment_detail_page(): void
    {
        $this->get(route('student.assignments.show', $this->assignment->id))
            ->assertStatus(200)
            ->assertSee('Detail Tugas')
            ->assertSee($this->assignment->description);
    }

    public function test_student_can_submit_an_assignment(): void
    {
        // Gunakan disk 'public' yang sama dengan controller
        Storage::fake('public');
        $file = UploadedFile::fake()->create('jawaban-saya.pdf', 200);

        $submissionData = [
            'file' => $file,
        ];

        // Pastikan Anda sudah memiliki rute bernama 'student.assignments.submit' di file web.php
        $this->post(route('student.assignments.submit', $this->assignment->id), $submissionData)
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('submissions', [
            'student_id' => $this->student->id,
            'assignment_id' => $this->assignment->id,
        ]);

        $submission = $this->student->submissions()->first();
        $this->assertNotNull($submission, 'Submission should not be null.');
        
        // Periksa di disk 'public'
        Storage::disk('public')->assertExists($submission->file_path);
    }
}