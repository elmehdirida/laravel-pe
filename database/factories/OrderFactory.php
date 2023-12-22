<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //generate random data for the order table
            'total_amount' => $this->faker->randomFloat(2, 0, 1000),
            'order_status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'declined']),
            'order_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
