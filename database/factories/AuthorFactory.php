<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_prefix' => fake()->title(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'name_suffix' => fake()->title(),
            'slug' => uniqid(),
            'birth_date' => fake()->dateTime(),
            'death_date' => fake()->dateTime(),
            'description' => fake()->text(1000)
        ];
    }
}
