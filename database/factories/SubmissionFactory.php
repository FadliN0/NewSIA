<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fileName = $this->faker->uuid . '.pdf';
        return [
            'student_id' => Student::factory(),
            'assignment_id' => Assignment::factory(),
            'file_path' => 'submissions/' . $fileName,
            'file_name' => 'jawaban-' . $this->faker->word . '.pdf',
        ];
    }
}