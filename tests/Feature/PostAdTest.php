<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\TipGoriva;
use App\Models\Karoserija;

class PostAdTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Run seeders for categories
        $this->seed(\Database\Seeders\TipGorivaSeeder::class);
        $this->seed(\Database\Seeders\KaroserijaSeeder::class);
    }

    /** @test */
    public function korisnik_moze_postaviti_novi_oglas()
    {
        Storage::fake('public');
        // Kreiraj korisnika
        $user = User::factory()->create();
        // Pripremi dva lažna image fajla
        $slika1 = UploadedFile::fake()->image('auto1.jpg');
        $slika2 = UploadedFile::fake()->image('auto2.jpg');
        // Pošalji POST zahtev kao prijavljeni korisnik
        $response = $this->actingAs($user)
                         ->post('/oglasi', [
                             'marka' => 'TestMarka',
                             'model' => 'TestModel',
                             'godiste' => 2020,
                             'cena' => 10000,
                             'opis' => 'Test opis vozila',
                             'gorivo' => TipGoriva::first()->id,
                             'karoserija' => Karoserija::first()->id,
                             'kilometraza' => 50000,
                             'snaga_motora' => 150,
                             'boja' => 'Crvena',
                             'lokacija' => 'Beograd',
                             'slike' => [ $slika1, $slika2 ]
                         ]);
        $response->assertRedirectContains('/oglasi/'); // preusmerava na stranicu oglasa
        $this->assertDatabaseHas('oglasi', [
            'marka' => 'TestMarka',
            'model' => 'TestModel',
            'status' => 'na čekanju'
        ]);
        // Proveri da su slike snimljene i fajlovi postoje
        $oglas = \App\Models\Oglas::where('marka','TestMarka')->first();
        $this->assertNotNull($oglas);
        $this->assertEquals(2, $oglas->fotografije()->count());
        foreach ($oglas->fotografije as $foto) {
            Storage::disk('public')->assertExists($foto->putanja);
        }
    }
}
