<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Fasilitas Umum'],
            ['name' => 'Dukungan Kesehatan'],
            ['name' => 'Pendidikan'],
            ['name' => 'Rekomendasi Tempat'],
        ];

        DB::table('services')->insert($services);
    }
}
