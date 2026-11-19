<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carinderia = Eatery::where('slug', 'carinderia-ni-argoncillo')->firstOrFail();
        $tita = User::where('email', 'tita.argoncillo@kaonta.test')->firstOrFail();
        $sai = User::where('email', 'argoncillo@kaonta.test')->firstOrFail();

        Review::create([
            'eatery_id' => $carinderia->id,
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Argoncillo.',
        ]);
        Review::create([
            'eatery_id' => $carinderia->id,
            'user_id' => $sai->id,
            'rating' => 4,
            'body' => 'The local dishes are tasty and the servings are generous.',
        ]);
        Review::create([
            'eatery_id' => $carinderia->id,
            'user_id' => User::whereNotIn('id', [$tita->id, $sai->id])->inRandomOrder()->firstOrFail()->id,
            'rating' => 5,
            'body' => 'Good food and a friendly place near Poblacion.',
        ]);

        $users = User::all();
        Eatery::where('is_open', true)
            ->where('slug', '!=', 'carinderia-ni-argoncillo')
            ->each(function (Eatery $eatery) use ($users): void {
                Review::factory()->count(fake()->numberBetween(0, 6))->create([
                    'eatery_id' => $eatery->id,
                    'user_id' => fn (): int => $users->random()->id,
                ]);
            });
    }
}
