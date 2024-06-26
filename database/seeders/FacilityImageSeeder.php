<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FacilityImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            DB::table('facility_images')->insert([
                'facility_id' => $faker->numberBetween(1, 10),
                'image' => $faker->imageUrl(640, 480, 'facility', true, 'Faker'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
