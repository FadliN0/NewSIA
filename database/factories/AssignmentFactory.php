<?php

namespace Database\Factories;

use App\Models\ClassRoom; // Import ClassRoom
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            // --- BAGIAN INI DIPERBAIKI ---
            // Menyediakan semua kolom yang dibutuhkan oleh tabel assignments
            'teacher_id' => Teacher::factory(),
            'subject_id' => Subject::factory(),
            'class_room_id' => ClassRoom::factory(), // Menambahkan class_room_id
            'title' => 'Tugas ' . $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
        ];
    }
}