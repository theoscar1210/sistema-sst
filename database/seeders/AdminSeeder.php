<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super',
            'last_name' => 'Administrador',
            'email' => 'administrador@sistemasst.com',
            'password' => 'Admin123!',
            'role' => 'super_admin',
        ]);
    }
}
