<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //generate random data for the product table
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => $this->faker->numberBetween(1, 10),
            'discount_id' => $this->faker->numberBetween(1, 10),
            'image' => 'https://picsum.photos/200/300',
        ];
    }
}
