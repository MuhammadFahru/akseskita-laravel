<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userServices = [
            ['user_id' => 2, 'service_id' => 1],
            ['user_id' => 2, 'service_id' => 2],
            ['user_id' => 3, 'service_id' => 1],
            ['user_id' => 3, 'service_id' => 3],
        ];

        DB::table('user_services')->insert($userServices);
    }
}
