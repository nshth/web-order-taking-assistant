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
            'name' => fake()->word(),
            // Added parameters to randomFloat (2 decimals, min 10, max 100)
            'price' => fake()->randomFloat(2, 10, 100), 
            // Use randomElement to pick from your list
            'stock' => fake()->randomElement([25, 18, 10, 30, 14, 7, 3, 0]),
            'description' => fake()->sentence(10),
    ];
    }
}
