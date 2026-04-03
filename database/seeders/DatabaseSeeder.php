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
            'password' => bcrypt('password'), // Don't forget to hash the password
        ]);
        $peserta = Peserta::create([
            'name' => 'Riki Ulir',
            'nim' => '1234567890',
            'email' => 'rikiulir@example.com',
        ]);
        User::create([
            'name' => 'User',
            'username' => 'miau',
            'id_peserta' => $peserta->id,
            'role' => 'user',
            'password' => bcrypt('password'), // Don't forget to hash the password
        ]);

        // data user & peserta dummy untuk voting
        $peserta_b = Peserta::create([
            'name' => 'Lorem Ipsum',
            'nim' => '4352463668',
            'email' => 'lorem@example.com',
        ]);
        User::create([
            'name' => 'Lorem',
            'username' => 'lorem',
            'id_peserta' => $peserta_b->id,
            'role' => 'user',
            'password' => bcrypt('loremipsum'), // Don't forget to hash the password
        ]);

        $peserta_c = Peserta::create([
            'name' => 'Pengguna Dummy 2',
            'nim' => '4352463700',
            'email' => 'penggunadummy2@example.com',
        ]);
        User::create([
            'name' => 'Pengguna Dummy 2',
            'username' => 'dummy 2',
            'id_peserta' => $peserta_c->id,
            'role' => 'user',
            'password' => bcrypt('password'), // Don't forget to hash the password
        ]);

        $peserta_d = Peserta::create([
            'name' => 'Pengguna Dummy 3',
            'nim' => '4352463800',
            'email' => 'penggunadummy3@example.com',
        ]);
        User::create([
            'name' => 'Pengguna Dummy 3',
            'username' => 'dummy 3',
            'id_peserta' => $peserta_d->id,
            'role' => 'user',
            'password' => bcrypt('password'), // Don't forget to hash the password
        ]);
    }
}
