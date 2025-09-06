<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassRoom>
 */
class ClassRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Kelas ' . $this->faker->unique()->randomElement(['10A', '10B', '11A', '11B', '12A', '12B']),
            // -- BARIS INI YANG DIPERBAIKI --
            'grade_level' => $this->faker->randomElement(['10', '11', '12']),
        ];
    }
}
