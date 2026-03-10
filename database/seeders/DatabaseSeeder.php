<?php

namespace Database\Seeders;

use App\Models\Peserta;
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
            'password' => 'password', // Don't forget to hash the password
        ]);
        $peserta = Peserta::create([
            'name' => 'Riki Ulir',
            'nim' => '1234567890',
            'email' => 'rikiulir@example.com'
        ]);
        User::create([
            'name' => 'User',
            'username' => 'miau',
            'id_peserta' => $peserta->id,
             'role' => 'user',
            'password' => 'password', // Don't forget to hash the password
        ]);
    }
}
