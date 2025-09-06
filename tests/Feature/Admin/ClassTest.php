<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminClassTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_admin_can_view_class_list_page(): void
    {
        $this->get(route('admin.classes.index'))
            ->assertStatus(200)
            ->assertSee('Kelola Kelas');
    }

    public function test_admin_can_create_a_new_class(): void
    {
        $classData = [
            'name' => '12 IPA 1',
            'grade_level' => '12',
            'max_students' => 30, // Kembali menggunakan max_students
        ];

        $this->post(route('admin.classes.store'), $classData)
            ->assertRedirect(route('admin.classes.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('class_rooms', $classData);
    }

    public function test_admin_can_update_a_class(): void
    {
        $class = ClassRoom::factory()->create();
        $updatedData = [
            'name' => '12 IPS 3',
            'grade_level' => '12',
            'max_students' => 32, // Kembali menggunakan max_students
        ];

        $this->put(route('admin.classes.update', $class->id), $updatedData)
            ->assertRedirect(route('admin.classes.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('class_rooms', ['id' => $class->id, ...$updatedData]);
    }

    public function test_admin_can_delete_a_class(): void
    {
        $class = ClassRoom::factory()->create();

        $this->delete(route('admin.classes.destroy', $class->id))
            ->assertRedirect(route('admin.classes.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('class_rooms', ['id' => $class->id]);
    }
}