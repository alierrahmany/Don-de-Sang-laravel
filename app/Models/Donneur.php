<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Donneur extends Model
{
    use HasFactory;

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

    protected $casts = [
        'date_naissance' => 'date',
        'dernier_don' => 'date',
        'disponible' => 'boolean',
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

    public function receveursAssignes()
    {
        return $this->belongsToMany(Receveur::class, 'assignations')
                    ->withPivot('date_assignation', 'statut', 'notes')
                    ->withTimestamps();
    }

    public function getEstDisponiblePourDonAttribute()
    {
        if (!$this->disponible) {
            return false;
        }

        if ($this->dernier_don) {
            return $this->dernier_don->diffInMonths(now()) >= 3;
        }

        return true;
    }
}