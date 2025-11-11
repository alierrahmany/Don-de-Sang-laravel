<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receveur extends Model
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
        'ville',
        'groupe_sanguin',
        'besoin_medical',
        'date_urgence',
        'urgence',
        'statut'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_urgence' => 'date',
        'urgence' => 'boolean',
        'statut' => 'boolean',
    ];

}