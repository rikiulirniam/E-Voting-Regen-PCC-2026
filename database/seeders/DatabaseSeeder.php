<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'rikiulir',
            'role' => 'admin',
            'password' => bcrypt('password'), // Don't forget to hash the password
        ]);
        User::create([
            'name' => 'User',
            'username' => 'miau',
            'password' => bcrypt('password'), // Don't forget to hash the password
        ]);
    }
}
