<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
                'birthdate' => null,
                'gender' => null,
                'no_telp' => null,
                'foto_profile' => null,
                'is_verified' => true,
                'disability_type' => null,
                'email_verified_at' => now(),
                'verification_code' => null,
                'remember_token' => Str::random(10),
                'created_by' => null,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'birthdate' => '1990-01-01',
                'gender' => 'Laki-laki',
                'no_telp' => '08123456789',
                'foto_profile' => 'https://avatar.iran.liara.run/public/22',
                'is_verified' => true,
                'disability_type' => "Tuna Rungu",
                'email_verified_at' => now(),
                'verification_code' => null,
                'remember_token' => Str::random(10),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'birthdate' => '1992-02-02',
                'gender' => 'Perempuan',
                'no_telp' => '08129876543',
                'foto_profile' => 'https://avatar.iran.liara.run/public/97',
                'is_verified' => false,
                'disability_type' => 'Tuna Netra',
                'email_verified_at' => null,
                'verification_code' => Str::random(6),
                'remember_token' => Str::random(10),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
