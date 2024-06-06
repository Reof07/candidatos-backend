<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios específicos
        $users = collect([
            ['username' => 'tester', 'password' => 'PASSWORD', 'role' => 'manager'],
            ['username' => 'agent', 'password' => 'PASSWORD', 'role' => 'agent'],
        ])->map(function ($user) {
            return array_merge($user, ['password' => bcrypt($user['password'])]);
        });

        // Insertar usuarios específicos
        User::insert($users->toArray());

        // Crear usuarios aleatorios
        User::factory()->count(10)->create();
    }
}
