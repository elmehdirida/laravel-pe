<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //generate random data for the payment table
            'order_id' => $this->faker->numberBetween(1, 10),
            'payment_method' => $this->faker->randomElement(['paypal', 'visa', 'mastercard']),
            'payment_status' => $this->faker->randomElement(['processing', 'completed', 'declined']),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
