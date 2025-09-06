<?php

namespace Tests\Feature\Admin;

use App\Models\ClassRoom;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAssignmentTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_admin_can_view_assignment_list_page(): void
    {
        TeacherSubject::factory()->create();

        $this->get(route('admin.assignments.index'))
            ->assertStatus(200)
            ->assertSee('Penugasan Mengajar');
    }

    public function test_admin_can_view_create_assignment_page(): void
    {
        $this->get(route('admin.assignments.create'))
            ->assertStatus(200)
            ->assertSee('Tugaskan Guru ke Kelas');
    }

    public function test_admin_can_create_a_new_assignment(): void
    {
        $teacher = Teacher::factory()->create();
        $subject = Subject::factory()->create();
        $classRoom = ClassRoom::factory()->create();
        $semester = Semester::factory()->create(['is_active' => true]);

        $assignmentData = [
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_room_id' => $classRoom->id,
        ];

        $this->post(route('admin.assignments.store'), $assignmentData)
            ->assertRedirect(route('admin.assignments.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('teacher_subjects', [
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_room_id' => $classRoom->id,
            'semester_id' => $semester->id,
        ]);
    }

    public function test_admin_cannot_create_a_duplicate_assignment(): void
    {
        // --- INI BAGIAN YANG DIPERBAIKI ---
        // 1. Buat semua data yang dibutuhkan, termasuk semester aktif
        $activeSemester = Semester::factory()->create(['is_active' => true]);
        $teacher = Teacher::factory()->create();
        $subject = Subject::factory()->create();
        $classRoom = ClassRoom::factory()->create();

        // 2. Buat penugasan yang sudah ada DENGAN semester yang aktif
        TeacherSubject::create([
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_room_id' => $classRoom->id,
            'semester_id' => $activeSemester->id,
        ]);

        // 3. Kirim data duplikat yang sama persis
        $duplicateData = [
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'class_room_id' => $classRoom->id,
        ];

        $this->post(route('admin.assignments.store'), $duplicateData)
            ->assertSessionHas('error');
    }

    public function test_admin_can_delete_an_assignment(): void
    {
        $assignment = TeacherSubject::factory()->create();

        $this->delete(route('admin.assignments.destroy', $assignment->id))
            ->assertRedirect(route('admin.assignments.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('teacher_subjects', ['id' => $assignment->id]);
    }
}
