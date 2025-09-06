<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    public function definition(): array
    {
        return [
            // --- BAGIAN INI DIPERBAIKI ---
            'student_id' => Student::factory(),
            'subject_id' => Subject::factory(),
            'semester_id' => Semester::factory(),
            'grade_type' => $this->faker->randomElement(['Tugas','UTS', 'UAS']), // Menghasilkan tipe yang valid
            'score' => $this->faker->numberBetween(60, 100), // Mengisi kolom 'score'
        ];
    }
}
