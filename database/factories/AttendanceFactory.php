<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\TeacherSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'teacher_subject_id' => TeacherSubject::factory(),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['present', 'absent', 'permission', 'sick']),
        ];
    }
}