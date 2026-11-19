<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Sai Winnie Argoncillo',
            'email' => 'argoncillo@kaonta.test',
            'password' => 'kaonta2026',
        ]);

        User::factory()->create([
            'name' => 'Tita Argoncillo',
            'email' => 'tita.argoncillo@kaonta.test',
            'password' => 'kaonta2026',
        ]);

        User::factory()->count(10)->create();
    }
}
