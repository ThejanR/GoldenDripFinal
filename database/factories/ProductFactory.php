<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 2, 20), // Price between $2 and $20
            'image' => 'https://via.placeholder.com/150',
            'is_available' => true,
            'category_id' => Category::factory(), // Automatically creates a category for the product
        ];
    }
}