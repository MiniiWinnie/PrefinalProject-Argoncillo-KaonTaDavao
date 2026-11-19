<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement(['Chicken Meal', 'Pork Adobo', 'Kinilaw', 'Lugaw', 'Durian Shake']),
            'price' => fake()->randomFloat(2, 40, 250),
            'is_bestseller' => fake()->boolean(20),
        ];
    }
}
