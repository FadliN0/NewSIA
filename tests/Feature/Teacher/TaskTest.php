<?php

namespace Tests\Feature\Teacher;

use App\Models\Assignment;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TeacherTaskTest extends TestCase
{
    use RefreshDatabase;

    protected Teacher $teacher;
    protected TeacherSubject $assignmentScope; // Ini adalah "ruang lingkup" tugas guru

    protected function setUp(): void
    {
        parent::setUp();
        $this->teacher = Teacher::factory()->create();
        $this->actingAs($this->teacher->user);

        // Siapkan satu data TeacherSubject yang akan kita gunakan di semua tes.
        // Ini merepresentasikan guru yang mengajar mapel tertentu di kelas tertentu.
        $this->assignmentScope = TeacherSubject::factory()->create([
            'teacher_id' => $this->teacher->id,
        ]);
    }

    public function test_teacher_can_view_task_list_page(): void
    {
        $this->get(route('teacher.assignments.index'))
            ->assertStatus(200)
            ->assertSee('Kelola Tugas');
    }

    // Breakdown: Gagal karena validasi controller butuh 'teacher_subject_id'
    public function test_teacher_can_create_a_new_task_without_file(): void
    {
        $taskData = [
            // DIPERBAIKI: Mengirim ID dari lingkup penugasan
            'teacher_subject_id' => $this->assignmentScope->id,
            'title' => 'Kerjakan Latihan Bab 5',
            'description' => 'Kerjakan soal 1-10 di buku paket.',
            'due_date' => now()->addWeek()->format('Y-m-d\TH:i'),
        ];

        $this->post(route('teacher.assignments.store'), $taskData)
            ->assertRedirect(route('teacher.assignments.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('assignments', ['title' => 'Kerjakan Latihan Bab 5']);
    }

    // Breakdown: Gagal karena data tidak tersimpan akibat validasi gagal
    public function test_teacher_can_create_a_new_task_with_file(): void
    {
        Storage::fake('private');
        $file = UploadedFile::fake()->create('soal-tugas.pdf', 100);

        $taskData = [
            'teacher_subject_id' => $this->assignmentScope->id, // Mengirim ID lingkup
            'title' => 'Tugas Makalah PDF',
            'description' => 'Buatlah makalah berdasarkan file PDF terlampir.',
            'due_date' => now()->addWeek()->format('Y-m-d\TH:i'),
            'file' => $file,
        ];

        $this->post(route('teacher.assignments.store'), $taskData);

        $assignment = Assignment::where('title', 'Tugas Makalah PDF')->first();
        $this->assertNotNull($assignment); // Sekarang data akan ditemukan
        Storage::disk('private')->assertExists($assignment->file_path);
    }

    // Breakdown: Gagal karena factory tidak bisa membuat data awal
    public function test_teacher_can_update_a_task(): void
    {
        // Buat tugas yang terkait dengan lingkup penugasan guru
        $task = Assignment::factory()->create([
            'teacher_id' => $this->assignmentScope->teacher_id,
            'subject_id' => $this->assignmentScope->subject_id,
            'class_room_id' => $this->assignmentScope->class_room_id,
        ]);

        $updatedData = [
            'teacher_subject_id' => $this->assignmentScope->id, // Mengirim ID lingkup
            'title' => 'Judul Tugas Diperbarui',
            'description' => 'Deskripsi juga diperbarui.',
            'due_date' => now()->addMonth()->format('Y-m-d\TH:i'),
        ];

        $this->put(route('teacher.assignments.update', $task->id), $updatedData)
            ->assertRedirect(route('teacher.assignments.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('assignments', ['id' => $task->id, 'title' => 'Judul Tugas Diperbarui']);
    }

    // Breakdown: Gagal karena factory tidak bisa membuat data awal
    public function test_teacher_can_delete_a_task(): void
    {
        // Buat tugas yang terkait dengan lingkup penugasan guru
        $task = Assignment::factory()->create([
            'teacher_id' => $this->assignmentScope->teacher_id,
            'subject_id' => $this->assignmentScope->subject_id,
            'class_room_id' => $this->assignmentScope->class_room_id,
        ]);

        $this->delete(route('teacher.assignments.destroy', $task->id))
            ->assertRedirect(route('teacher.assignments.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('assignments', ['id' => $task->id]);
    }
}