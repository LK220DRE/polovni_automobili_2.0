<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Redosled je bitan: prvo šifarnici, pa oglasi
        $this->call([
            TipGorivaSeeder::class,
            KaroserijaSeeder::class,
            OglasSeeder::class,
        ]);

        // Napravi inicijalnog admin korisnika
        User::create([
            'ime' => 'Milos',
            'prezime' => 'Radovic',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);
    }
}
