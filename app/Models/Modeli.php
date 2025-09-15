<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modeli extends Model
{
    use HasFactory;

    protected $table = 'modeli';

    protected $fillable = ['naziv', 'marka_id'];

    public function marka()
    {
        return $this->belongsTo(Marka::class);
    }
}
