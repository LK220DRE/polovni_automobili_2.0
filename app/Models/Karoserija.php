<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model za karoseriju (vrsta vozila: limuzina, SUV, itd.).
 * Polja: naziv.
 */
class Karoserija extends Model
{
    use HasFactory;
    public $table = 'karoserije';
    protected $fillable = ['naziv'];

    /**
     * Jedna karoserija može biti povezana sa mnogim oglasima.
     */
    public function oglasi()
    {
        return $this->hasMany(Oglas::class);
    }
}
