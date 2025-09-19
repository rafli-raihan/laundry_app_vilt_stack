<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id_level' => 1,
                'name' => 'Super Admin',
                'email' => 'sudo@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'id_level' => 2,
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'id_level' => 3,
                'name' => 'Admin Operasional',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        ];
        foreach ($users as $v) {
            User::create([
                'id_level' => $v['id_level'],
                'name' => $v['name'],
                'email' => $v['email'],
                'password' => $v['password'],
            ]);
        }
    }
}
