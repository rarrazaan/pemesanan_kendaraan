<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role_name' => "admin", 
                'grade'=> 1,
            ],
            [
                'role_name' => "admin", 
                'grade'=> 2,
            ],
            [
                'role_name' => "approver", 
                'grade'=> 3,
            ],
            [
                'role_name' => "approver", 
                'grade'=> 4,
            ],
        ];
        Role::insert($data);
        
    }
}