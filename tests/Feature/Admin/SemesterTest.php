<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Semester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSemesterTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_admin_can_view_semester_list_page(): void
    {
        $this->get(route('admin.semesters.index'))
            ->assertStatus(200)
            ->assertSee('Kelola Semester');
    }

    public function test_admin_can_create_a_new_semester(): void
    {
        $semesterData = [
            'name' => 'Ganjil',
            'school_year' => '2025/2026',
            'start_date' => '2025-07-01',
            'end_date' => '2025-12-31',
            'is_active' => '1',
        ];

        $this->post(route('admin.semesters.store'), $semesterData)
            ->assertRedirect(route('admin.semesters.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('semesters', ['school_year' => '2025/2026']);
    }

    public function test_admin_can_update_a_semester(): void
    {
        $semester = Semester::factory()->create();
        $updatedData = [
            'name' => 'Genap',
            'school_year' => '2099/2100',
            'start_date' => '2099-01-01',
            'end_date' => '2099-06-30',
            'is_active' => '0',
        ];

        $this->put(route('admin.semesters.update', $semester->id), $updatedData)
            ->assertRedirect(route('admin.semesters.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('semesters', ['id' => $semester->id, 'school_year' => '2099/2100']);
    }
}
