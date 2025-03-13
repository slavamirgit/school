<?php

namespace Database\Factories;

use App\Models\Grade;
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
        $grade = Grade::inRandomOrder()->first();
        $sex = ['M', 'F'];

        return [
            'grade_id' => $grade->id,
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'sex' => $sex[rand(0, 1)],
            'age' => rand(5, 6) + (int)mb_substr($grade->name, 0, -1)
        ];
    }
}
