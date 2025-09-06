<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SemesterFactory extends Factory
{
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2023, 2026);
        return [
            'name' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'school_year' => $year . '/' . ($year + 1),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'is_active' => false,
        ];
    }
}
