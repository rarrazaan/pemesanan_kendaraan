<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(19)->create();
        $data = [
            [
            'name' => 'admin',
            'username' => 'admin', //strtok($fakeName,' ')
            'username_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id'   => 1,
            'remember_token' => Str::random(10),
            ],
            [
            'name' => 'approver',
            'username' => 'approver', //strtok($fakeName,' ')
            'username_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id'   => 4,
            'remember_token' => Str::random(10),
            ],
        ];
        User::insert($data);
    }
}