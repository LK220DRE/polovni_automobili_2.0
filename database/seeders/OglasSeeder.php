<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oglas;
use App\Models\User;
use App\Models\TipGoriva;
use App\Models\Karoserija;
use App\Models\Fotografija;

class OglasSeeder extends Seeder
{
    public function run(): void
    {
        // Napravi jednog korisnika (prodavca)
        $user = User::factory()->create([
            'ime' => 'Marko',
            'prezime' => 'Janković',
            'email' => 'marko@example.com',
            'password' => bcrypt('lozinka123'),
            'is_admin' => false,
        ]);

        // Bezbedno dohvaćanje ID-ova
        $benzinski = TipGoriva::where('naziv', 'Benzin')->first()?->id ?? TipGoriva::first()->id;
        $dizel     = TipGoriva::where('naziv', 'Dizel')->first()?->id ?? TipGoriva::first()->id;

        $karavan = Karoserija::where('naziv', 'Karavan')->first()?->id ?? Karoserija::first()->id;
        $hecbek  = Karoserija::where('naziv', 'Hečbek')->first()?->id ?? Karoserija::first()->id;
        $limuzina = Karoserija::where('naziv', 'Limuzina')->first()?->id ?? Karoserija::first()->id;

        // ============= ŠKODA OCTAVIA =============
        $skoda = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Škoda Octavia 2016',
            'marka'          => 'Škoda',
            'model'          => 'Octavia',
            'godiste'        => 2016,
            'cena'           => 9500,
            'opis'           => 'Auto u odličnom stanju, redovno servisiran.',
            'kilometraza'    => 120000,
            'snaga_motora'   => 110,
            'boja'           => 'Siva',
            'lokacija'       => 'Beograd',
            'status'         => 'odobren',
            'tip_goriva_id'  => $benzinski,
            'karoserija_id'  => $karavan,
        ]);

        Fotografija::create(['oglas_id' => $skoda->id, 'putanja' => 'images/demo/skoda1.jpg']);
        Fotografija::create(['oglas_id' => $skoda->id, 'putanja' => 'images/demo/skoda2.jpg']);
        Fotografija::create(['oglas_id' => $skoda->id, 'putanja' => 'images/demo/skoda3.jpg']);


        // ============= OPEL ASTRA =============
        $astra = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Opel Astra 2010',
            'marka'          => 'Opel',
            'model'          => 'Astra',
            'godiste'        => 2010,
            'cena'           => 4500,
            'opis'           => 'Drugi vlasnik, registrovana do decembra.',
            'kilometraza'    => 180000,
            'snaga_motora'   => 100,
            'boja'           => 'Crvena',
            'lokacija'       => 'Novi Sad',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $hecbek,
        ]);

        Fotografija::create(['oglas_id' => $astra->id, 'putanja' => 'images/demo/astra1.jpg']);
        Fotografija::create(['oglas_id' => $astra->id, 'putanja' => 'images/demo/astra2.jpg']);

        // ============= VW PASSAT =============
        $passat = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'VW Passat B7 2013',
            'marka'          => 'Volkswagen',
            'model'          => 'Passat',
            'godiste'        => 2013,
            'cena'           => 10500,
            'opis'           => 'Komforna limuzina, servisna istorija dostupna.',
            'kilometraza'    => 140000,
            'snaga_motora'   => 140,
            'boja'           => 'Plava',
            'lokacija'       => 'Smederevo',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $limuzina,
        ]);

        Fotografija::create(['oglas_id' => $passat->id, 'putanja' => 'images/demo/passat1.jpg']);
        Fotografija::create(['oglas_id' => $passat->id, 'putanja' => 'images/demo/passat2.jpg']);

        // ============= AUDI A4 =============
        $audi = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Audi A4 2015',
            'marka'          => 'Audi',
            'model'          => 'A4',
            'godiste'        => 2015,
            'cena'           => 12500,
            'opis'           => 'Elegantan automobil sa odličnim performansama.',
            'kilometraza'    => 110000,
            'snaga_motora'   => 150,
            'boja'           => 'Crna',
            'lokacija'       => 'Beograd',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $limuzina,
        ]);

        Fotografija::create(['oglas_id' => $audi->id, 'putanja' => 'images/demo/audi1.jpg']);
        Fotografija::create(['oglas_id' => $audi->id, 'putanja' => 'images/demo/audi2.jpg']);
        Fotografija::create(['oglas_id' => $audi->id, 'putanja' => 'images/demo/audi3.jpg']);
    }
}
