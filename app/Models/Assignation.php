<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'receveur_id',
        'donneur_id',
        'date_assignation',
        'notes'
    ];

    protected $casts = [
        'date_assignation' => 'datetime',
    ];

    // Relation avec le receveur
    public function receveur()
    {
        return $this->belongsTo(Receveur::class);
    }

    // Relation avec le donneur
    public function donneur()
    {
        return $this->belongsTo(Donneur::class);
    }
}