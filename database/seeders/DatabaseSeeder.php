<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('123678'),
            'id_level' => 1,
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123678'),
            'id_level' => 2,
        ]);
        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@mail.com',
            'password' => Hash::make('123678'),
            'id_level' => 3,
        ]);
    }
}
