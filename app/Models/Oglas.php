<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model za oglas (polovni automobil).
 * Polja: user_id, marka, model, godište, cena, opis, tip_goriva_id, karoserija_id, kilometraža, snaga_motora, boja, lokacija, status.
 */
class Oglas extends Model
{
    use HasFactory;

    protected $table = 'oglasi';   ///DODATO JER NIJE HTELO DA RADI

    protected $fillable = [
    'user_id',
    'naslov',
    'marka',
    'model',
    'godiste',
    'cena',
    'opis',
    'tip_goriva_id',
    'karoserija_id',
    'kilometraza',
    'snaga_motora',
    'boja',
    'lokacija',
    'status',
];


    /**
     * Oglas pripada jednom korisniku (prodavcu).
     */
    public function korisnik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Oglas ima više fotografija.
     */
    public function fotografije()
    {
        return $this->hasMany(Fotografija::class);
    }

    /**
     * Oglas pripada jednoj kategoriji tipa goriva.
     */
    public function tipGoriva()
    {
        return $this->belongsTo(TipGoriva::class, 'tip_goriva_id');
    }

    public function karoserija()
    {
        return $this->belongsTo(Karoserija::class, 'karoserija_id');
    }

}
