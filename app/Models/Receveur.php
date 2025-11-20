<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receveur extends Model
{
    use HasFactory;

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

    protected $casts = [
        'date_urgence' => 'date',
        'urgence' => 'boolean',
        'statut' => 'boolean',
    ];

    // Accessor pour le nom complet
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    // Relation avec les assignations
    public function assignations()
    {
        return $this->hasMany(Assignation::class);
    }

    public function donneursAssignes()
    {
        return $this->belongsToMany(Donneur::class, 'assignations')
                    ->withPivot('date_assignation', 'statut', 'notes')
                    ->withTimestamps();
    }

    public function getAssignationActiveAttribute()
    {
        return $this->assignations()->where('statut', 'assigné')->first();
    }
}