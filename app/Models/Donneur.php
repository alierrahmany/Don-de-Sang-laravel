<?php
// app/Models/Donneur.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Donneur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'genre',
        'groupe_sanguin',
        'ville',
        'date_naissance',
        'dernier_don',
        'disponible'
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_naissance' => 'date',
        'dernier_don' => 'date',
        'disponible' => 'boolean',
    ];


}