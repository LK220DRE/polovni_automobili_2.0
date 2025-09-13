<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaroserijaSeeder extends Seeder
{
    public function run(): void
    {
        $tipovi = ['Limuzina', 'Hečbek', 'Karavan', 'Kupe', 'Kabriolet', 'SUV'];
        foreach ($tipovi as $karoserija) {
            DB::table('karoserije')->insert(['naziv' => $karoserija, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}

