<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTeacherTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // Buat user admin dan login
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    // Test 1: Admin bisa melihat halaman daftar guru
    public function test_admin_can_view_teacher_list_page(): void
    {
        $this->get(route('admin.teachers.index'))
            ->assertStatus(200)
            ->assertSee('Kelola Guru');
    }

    // Test 2: Admin bisa melihat halaman tambah guru
    public function test_admin_can_view_create_teacher_page(): void
    {
        $this->get(route('admin.teachers.create'))
            ->assertStatus(200)
            ->assertSee('Tambah Guru Baru');
    }

    // Test 3: Admin berhasil membuat guru baru
    public function test_admin_can_create_a_new_teacher(): void
    {
        $teacherData = [
            'full_name' => 'Dr. Budi Cerdikiawan',
            'email' => 'budi.cerdik@sma.edu',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nip' => '198901012010121001',
            'gender' => 'male',
        ];

        $this->post(route('admin.teachers.store'), $teacherData)
            ->assertRedirect(route('admin.teachers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', ['email' => 'budi.cerdik@sma.edu', 'role' => 'teacher']);
        $this->assertDatabaseHas('teachers', ['nip' => '198901012010121001']);
    }

    // Test 4: Admin bisa melihat halaman edit guru
    public function test_admin_can_view_edit_teacher_page(): void
    {
        $teacher = Teacher::factory()->create();

        $this->get(route('admin.teachers.edit', $teacher->id))
            ->assertStatus(200)
            ->assertSee('Edit Data Guru')
            ->assertSee($teacher->full_name);
    }

    // Test 5: Admin bisa memperbarui data guru
    public function test_admin_can_update_teacher_data(): void
    {
        $teacher = Teacher::factory()->create();

        $updatedData = [
            'full_name' => 'Dr. Budi Diperbarui',
            'email' => $teacher->user->email, // email wajib diisi saat update
            'nip' => '112233445566778899',
            'gender' => $teacher->gender, // gender wajib diisi saat update
        ];

        $this->put(route('admin.teachers.update', $teacher->id), $updatedData)
            ->assertRedirect(route('admin.teachers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'full_name' => 'Dr. Budi Diperbarui',
            'nip' => '112233445566778899',
        ]);
    }

    // Test 6: Admin bisa menghapus data guru
    public function test_admin_can_delete_a_teacher(): void
    {
        $teacher = Teacher::factory()->create();
        $user = $teacher->user;

        $this->delete(route('admin.teachers.destroy', $teacher->id))
            ->assertRedirect(route('admin.teachers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
