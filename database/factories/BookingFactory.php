<?php

namespace Database\Factories;

use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $reservationDate = fake()->dateTimeThisMonth();
        return [
            'code' => fake()->randomNumber(6),
            'book_id' => fake()->numberBetween(1, 10),
            'user_id' => fake()->numberBetween(1, 10),
            'from' => $reservationDate,
            'to' => Date('Y-m-d h:i:s', strtotime('+1 month', $reservationDate->getTimestamp())),
            'borrowed' => fake()->boolean(),
            'returned' => fake()->boolean(),
        ];
    }
}
