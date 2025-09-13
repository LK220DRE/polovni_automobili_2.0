<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model za fotografiju oglasa.
 * Polja: oglas_id, putanja.
 */
class Fotografija extends Model
{
    use HasFactory;
    public $table = 'fotografije';
    protected $fillable = ['oglas_id', 'putanja'];

    /**
     * Fotografija pripada jednom oglasu.
     */
    public function oglas()
    {
        return $this->belongsTo(Oglas::class);
    }
}
