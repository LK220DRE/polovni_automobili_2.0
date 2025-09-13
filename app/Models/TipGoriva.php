<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model za tip goriva (benzín, dizel, itd.).
 * Polja: naziv.
 */
class TipGoriva extends Model
{
    use HasFactory;
    public $table = 'tip_goriva';
    protected $fillable = ['naziv'];

    /**
     * Jedan tip goriva može se pojaviti u mnogim oglasima.
     */
    public function oglasi()
    {
        return $this->hasMany(Oglas::class);
    }
}

