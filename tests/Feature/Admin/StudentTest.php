<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminStudentTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_student_list_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.students.index'));
        $response->assertStatus(200);
        $response->assertSee('Kelola Siswa');
    }

    public function test_admin_can_view_create_student_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.students.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Siswa Baru');
    }

    public function test_admin_can_create_a_new_student(): void
    {
        $classRoom = ClassRoom::factory()->create();

        $studentData = [
            'full_name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nis' => '123456789',
            'nisn' => '987654321',
            'gender' => 'male',
            'entry_year' => '2023',
            'class_room_id' => $classRoom->id,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.students.store'), $studentData);

        $response->assertRedirect(route('admin.students.index'));
        $response->assertSessionHas('success');

        // Pengecekan ke database dibuat lebih spesifik
        $this->assertDatabaseHas('users', [
            'email' => 'budi.santoso@example.com',
            'role' => 'student'
        ]);
        $this->assertDatabaseHas('students', [
            'nis' => '123456789',
            'full_name' => 'Budi Santoso'
        ]);
    }

    public function test_validation_fails_if_student_data_is_incomplete(): void
    {
        $studentData = [
            'full_name' => '',
            'email' => 'not-an-email',
            'password' => '123',
            'nis' => '',
            'nisn' => '',
            'gender' => '',
            'entry_year' => '',
            'class_room_id' => '',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.students.store'), $studentData);

        $response->assertSessionHasErrors(['full_name', 'email', 'password', 'nis', 'nisn', 'gender', 'entry_year', 'class_room_id']);
    }

    public function test_admin_can_view_edit_student_page(): void
    {
        $student = Student::factory()->create();
        $response = $this->actingAs($this->admin)->get(route('admin.students.edit', $student->id));

        $response->assertStatus(200);
        $response->assertSee('Edit Data Siswa');
        $response->assertSee($student->full_name);
    }

    public function test_admin_can_update_student_data(): void
    {
        $student = Student::factory()->create();
        $newClassRoom = ClassRoom::factory()->create();

        // -- INI BAGIAN YANG DIPERBAIKI --
        // Data yang dikirim harus lengkap sesuai aturan validasi
        $updatedData = [
            'full_name' => 'Budi Diperbarui',
            'email' => $student->user->email, // email tetap dikirim
            'nis' => '987654321',
            'nisn' => '1234567890',
            'gender' => $student->gender, // gender tetap dikirim
            'entry_year' => '2024',
            'class_room_id' => $newClassRoom->id,
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.students.update', $student->id), $updatedData);

        $response->assertRedirect(route('admin.students.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'full_name' => 'Budi Diperbarui',
            'nis' => '987654321',
        ]);
    }

    public function test_admin_can_delete_a_student(): void
    {
        $student = Student::factory()->create();
        $user = $student->user;

        $response = $this->actingAs($this->admin)->delete(route('admin.students.destroy', $student->id));

        $response->assertRedirect(route('admin.students.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}