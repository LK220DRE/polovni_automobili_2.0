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

        Fotografija::create(['oglas_id' => $astra->id, 'putanja' => 'images/demo/corsa1.jpg']);
        Fotografija::create(['oglas_id' => $astra->id, 'putanja' => 'images/demo/corsa2.jpg']);
        Fotografija::create(['oglas_id' => $astra->id, 'putanja' => 'images/demo/corsa3.jpg']);

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
        Fotografija::create(['oglas_id' => $passat->id, 'putanja' => 'images/demo/passat3.jpg']);

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

        // ============= BMW 320d 2014 =============
        $bmw = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'BMW 320d 2014',
            'marka'          => 'BMW',
            'model'          => '320d',
            'godiste'        => 2014,
            'cena'           => 11500,
            'opis'           => 'Odlično očuvan, sportski paket, pun opreme.',
            'kilometraza'    => 180000,
            'snaga_motora'   => 163,
            'boja'           => 'Crna',
            'lokacija'       => 'Novi Sad',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $limuzina,
        ]);
        Fotografija::create(['oglas_id' => $bmw->id, 'putanja' => 'images/demo/bmw1.jpg']);
        Fotografija::create(['oglas_id' => $bmw->id, 'putanja' => 'images/demo/bmw2.jpg']);

        // ============= Mercedes C200 2015 =============
        $mercedes = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Mercedes C200 2015',
            'marka'          => 'Mercedes-Benz',
            'model'          => 'C200',
            'godiste'        => 2015,
            'cena'           => 14500,
            'opis'           => 'Perfektan enterijer i motor, AMG felne.',
            'kilometraza'    => 150000,
            'snaga_motora'   => 184,
            'boja'           => 'Bela',
            'lokacija'       => 'Beograd',
            'status'         => 'odobren',
            'tip_goriva_id'  => $benzinski,
            'karoserija_id'  => $limuzina,
        ]);
        Fotografija::create(['oglas_id' => $mercedes->id, 'putanja' => 'images/demo/mercedes1.webp']);
        Fotografija::create(['oglas_id' => $mercedes->id, 'putanja' => 'images/demo/mercedes2.jpg']);

        // ============= Peugeot 308 2017 =============
        $peugeot = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Peugeot 308 2017',
            'marka'          => 'Peugeot',
            'model'          => '308',
            'godiste'        => 2017,
            'cena'           => 7800,
            'opis'           => 'Mali potrošač, idealan gradski auto.',
            'kilometraza'    => 95000,
            'snaga_motora'   => 120,
            'boja'           => 'Plava',
            'lokacija'       => 'Niš',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $hecbek,
        ]);
        Fotografija::create(['oglas_id' => $peugeot->id, 'putanja' => 'images/demo/peugeot1.jpg']);
        Fotografija::create(['oglas_id' => $peugeot->id, 'putanja' => 'images/demo/peugeot2.jpg']);

        // ============= Ford Focus 2013 =============
        $ford = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Ford Focus 2013',
            'marka'          => 'Ford',
            'model'          => 'Focus',
            'godiste'        => 2013,
            'cena'           => 6200,
            'opis'           => 'Praktičan i ekonomičan automobil.',
            'kilometraza'    => 170000,
            'snaga_motora'   => 115,
            'boja'           => 'Siva',
            'lokacija'       => 'Kragujevac',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $hecbek,
        ]);
        Fotografija::create(['oglas_id' => $ford->id, 'putanja' => 'images/demo/ford1.jpg']);

        // ============= Renault Megane 2012 =============
        $renault = Oglas::create([
            'user_id'        => $user->id,
            'naslov'         => 'Renault Megane 2012',
            'marka'          => 'Renault',
            'model'          => 'Megane',
            'godiste'        => 2012,
            'cena'           => 5000,
            'opis'           => 'Pouzdan auto, registrovan do kraja godine.',
            'kilometraza'    => 200000,
            'snaga_motora'   => 110,
            'boja'           => 'Crvena',
            'lokacija'       => 'Subotica',
            'status'         => 'odobren',
            'tip_goriva_id'  => $dizel,
            'karoserija_id'  => $karavan,
        ]);
        Fotografija::create(['oglas_id' => $renault->id, 'putanja' => 'images/demo/renault1.jpg']);
        Fotografija::create(['oglas_id' => $renault->id, 'putanja' => 'images/demo/renault2.jpg']);

    }
}
