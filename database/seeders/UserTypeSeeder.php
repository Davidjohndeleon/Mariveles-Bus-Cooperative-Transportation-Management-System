<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'admin',
        ]);

        User::create([
            'name' => 'Driver User',
            'email' => 'driver@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'driver',
        ]);

        User::create([
            'name' => 'Checkpoint Staff',
            'email' => 'checkpoint@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'checkpoint',
        ]);

        User::create([
            'name' => 'Passenger User',
            'email' => 'passenger@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'passenger',
        ]);

        User::create([
            'name' => 'Conductor User',
            'email' => 'conductor@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'conductor',
        ]);
    }
}
