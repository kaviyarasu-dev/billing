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
            'name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'tax' => $this->faker->randomFloat(2, 5, 18),
        ];
    }
}
