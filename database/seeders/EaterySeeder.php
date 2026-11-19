<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Dish;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poblacion = District::where('name', 'Poblacion')->firstOrFail();
        $eatery = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => 'Carinderia ni Argoncillo',
            'slug' => Str::slug('Carinderia ni Argoncillo'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        Permit::create([
            'eatery_id' => $eatery->id,
            'permit_no' => 'DVO-2026-1116',
            'expires_on' => Carbon::create(2027, 11, 16),
        ]);
        $eatery->features()->sync(
            Feature::whereIn('name', ['Suki ni Argoncillo', 'Budget Meal'])->pluck('id')
        );

        Dish::create([
            'eatery_id' => $eatery->id,
            'name' => 'Tinolang Manok',
            'price' => 85.00,
            'is_bestseller' => true,
        ]);
        Dish::create([
            'eatery_id' => $eatery->id,
            'name' => 'Kinilaw na Tuna',
            'price' => 120.00,
            'is_bestseller' => false,
        ]);
        Dish::create([
            'eatery_id' => $eatery->id,
            'name' => 'Durian Shake',
            'price' => 75.00,
            'is_bestseller' => false,
        ]);

        $districtIds = District::pluck('id');
        $featureIds = Feature::pluck('id');

        for ($i = 0; $i < 11; $i++) {
            $factoryEatery = Eatery::factory()->create([
                'district_id' => $districtIds->random(),
                'is_open' => true,
            ]);
            Permit::factory()->create(['eatery_id' => $factoryEatery->id]);
            Dish::factory()->count(fake()->numberBetween(2, 5))->create([
                'eatery_id' => $factoryEatery->id,
            ]);
            $factoryEatery->features()->attach(
                $featureIds->random(fake()->numberBetween(1, 3))->all()
            );
        }

        for ($i = 0; $i < 3; $i++) {
            $factoryEatery = Eatery::factory()->closed()->create([
                'district_id' => $districtIds->random(),
            ]);
            Permit::factory()->create([
                'eatery_id' => $factoryEatery->id,
                'expires_on' => $i === 0
                    ? Carbon::now()->subYear()
                    : fake()->dateTimeBetween('+1 month', '+2 years'),
            ]);
            Dish::factory()->count(fake()->numberBetween(2, 5))->create([
                'eatery_id' => $factoryEatery->id,
            ]);
            $factoryEatery->features()->attach(
                $featureIds->random(fake()->numberBetween(1, 3))->all()
            );
        }
    }
}
