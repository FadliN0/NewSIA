<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Menyesuaikan dengan struktur data lengkap di DatabaseSeeder
        return [
            'user_id' => User::factory()->create(['role' => 'student']),
            'class_room_id' => ClassRoom::factory(),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'nis' => $this->faker->unique()->numerify('########'),
            'full_name' => $this->faker->name(), // <-- DIPERBAIKI: Menggunakan full_name
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->date(),
            'birth_place' => $this->faker->city(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'parent_name' => $this->faker->name('female'), // Asumsi ibu
            'parent_phone' => $this->faker->phoneNumber(),
            'entry_year' => $this->faker->numberBetween(2023, 2025),
        ];
    }
}
