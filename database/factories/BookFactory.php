<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'work_id' => fake()->numberBetween(1, 10),
            'title' => fake()->text(50),
            'subtitle' => fake()->text(80),
            'length' => fake()->numberBetween(50, 300),
            'language' => fake()->randomElement(['čeština', 'angličtina', 'němčina', 'francouzština']),
            'translator' => fake()->name(),
            'illustrator' => fake()->name(),
            'description' => fake()->text(),
            'house' => fake()->word(),
            'year' => fake()->year(),
            'publication' => fake()->numberBetween(1, 6),
            'place' => fake()->city(),
            'ISBN' => fake()->isbn10(),
            'amount' => fake()->numberBetween(1, 5)
        ];
    }
}
