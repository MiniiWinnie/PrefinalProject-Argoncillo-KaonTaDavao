<?php

namespace Database\Factories;

use App\Models\Permit;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permit>
 */
class PermitFactory extends Factory
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
            'permit_no' => 'DVO-'.fake()->numberBetween(2026, 2026).'-'.fake()->unique()->numberBetween(1000, 99999),
            'expires_on' => fake()->optional(0.25)->dateTimeBetween('-2 years', '-1 day') ?? fake()->dateTimeBetween('+1 month', '+2 years'),
        ];
    }
}
