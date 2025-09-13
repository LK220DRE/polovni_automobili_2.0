<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Oglas;
use App\Models\TipGoriva;
use App\Models\Karoserija;

class AdminModerationTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $oglas;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\TipGorivaSeeder::class);
        $this->seed(\Database\Seeders\KaroserijaSeeder::class);
        // Napravi admin korisnika
        $this->admin = User::factory()->create([ 'is_admin' => true ]);
        // Napravi obicnog korisnika i oglas
        $user = User::factory()->create();
        $this->oglas = Oglas::create([
            'user_id' => $user->id,
            'marka' => 'TestMarka2',
            'model' => 'TestModel2',
            'godiste' => 2015,
            'cena' => 8000,
            'opis' => 'Test opis2',
            'tip_goriva_id' => TipGoriva::first()->id,
            'karoserija_id' => Karoserija::first()->id,
            'kilometraza' => 100000,
            'snaga_motora' => 120,
            'boja' => 'Plava',
            'lokacija' => 'Novi Sad'
        ]);
    }

    /** @test */
    public function admin_moze_odobriti_oglas()
    {
        // Admin odobrava oglas
        $response = $this->actingAs($this->admin)
                         ->post('/admin/oglasi/'.$this->oglas->id.'/odobri');
        $response->assertRedirect('/admin/oglasi');
        $this->assertDatabaseHas('oglasi', [ 'id' => $this->oglas->id, 'status' => 'odobren' ]);
    }
}
