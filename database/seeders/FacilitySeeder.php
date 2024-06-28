<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('facilities')->insert([
                'name' => $faker->company,
                'description' => $faker->sentence,
                'category' => $faker->randomElement(['Hospital', 'School', 'Mall', 'Park', 'Library']),
                'address' => $faker->address,
                'is_favorite' => $faker->boolean,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'tuna_netra_friendly_status' => $faker->randomElement([1, 2, 3]),
                // 'tuna_rungu_friendly_status' => $faker->randomElement([1, 2, 3]),
                'tuna_daksa_friendly_status' => $faker->randomElement([1, 2, 3]),
                // 'tuna_wicara_friendly_status' => $faker->randomElement([1, 2, 3]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
