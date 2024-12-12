<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
            'name' => fake()->words(2, true),
            'price' => fake()->randomNumber(5,true),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'rating' => fake()->numberBetween(1,5),
            'sold' => fake()->numberBetween(100,5000),
            'description' => fake()->sentence(),
            'info' => fake()->sentence(),
            'stock' => fake()->numberBetween(10,500),
        ];
    }
}
