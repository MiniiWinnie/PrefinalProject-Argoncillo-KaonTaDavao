<?php

namespace Database\Factories;

use App\Models\Eatery;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Eatery>
 */
class EateryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'district_id' => District::factory(),
            'name' => fake()->unique()->company().' Eatery',
            'slug' => fake()->unique()->slug(),
            'address' => fake()->streetAddress().', Davao City',
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement(['Adobong Manok', 'Kinilaw', 'Tinolang Manok', 'Sinigang']),
            'is_open' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn (): array => ['is_open' => false]);
    }
}
