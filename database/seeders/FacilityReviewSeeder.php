<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FacilityReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('facility_review')->insert([
                'facility_id' => $faker->numberBetween(1, 10),
                'user_id' => $faker->numberBetween(2, 5),
                'review' => $faker->sentence,
                'rating' => $faker->randomFloat(2, 1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
