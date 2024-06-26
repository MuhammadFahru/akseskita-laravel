<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ServiceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserServiceSeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(FacilityImageSeeder::class);
        $this->call(FacilityReviewSeeder::class);
    }
}
