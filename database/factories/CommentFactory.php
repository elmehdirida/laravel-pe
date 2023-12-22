<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //generate random data for the comment table
            'text' => $this->faker->text(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, 10),
            'rating' => $this->faker->numberBetween(1, 5),
            'date' => $this->faker->dateTimeBetween('-1 years', 'now'),

        ];
    }
}
