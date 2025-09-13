<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipGorivaSeeder extends Seeder
{
    public function run(): void
    {
        $tipovi = ['Benzin', 'Dizel', 'Električni', 'Hibrid', 'Plin'];
        foreach ($tipovi as $gorivo) {
            DB::table('tip_goriva')->insert(['naziv' => $gorivo, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
