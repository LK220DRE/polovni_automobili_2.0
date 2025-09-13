<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model za korisnika sistema (kupci/prodavci i admin).
 * Polja: ime, prezime, email, password, is_admin.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'ime', 'prezime', 'email', 'password', 'is_admin'
    ];

    /**
     * Hidden attributes for arrays (like password, remember token).
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Default attribute casting.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * Korisnik može imati više oglasa (jedan kupac/prodavac => više oglasa).
     */
    public function oglasi()
    {
        return $this->hasMany(Oglas::class);
    }
}

