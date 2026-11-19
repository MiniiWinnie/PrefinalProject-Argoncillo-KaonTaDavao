<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            'Suki ni Argoncillo',
            'Budget Meal',
            'Halal',
            'Open 24 Hours',
            'Aircon',
            'Free Wi-Fi',
        ] as $name) {
            Feature::create(['name' => $name]);
        }
    }
}
