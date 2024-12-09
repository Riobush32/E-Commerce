<?php

namespace Database\Factories;

use App\Models\Icon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'icon_id' => fake()->numberBetween(1,10),
            'color' => fake()->hexColor(),
        ];
    }
}
