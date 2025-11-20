<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Donneur;
use App\Models\Receveur;
use App\Models\Assignation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord
     */
    public function index()
    {
        // Statistiques des donneurs
        $totalDonneurs = Donneur::count();
        $donneursDisponibles = Donneur::where('disponible', true)->count();

        // Statistiques des receveurs
        $totalReceveurs = Receveur::count();
        $receveursEnAttente = Receveur::where('statut', true)->count();
        $receveursUrgents = Receveur::where('urgence', true)->count();
        $receveursSatisfaits = Receveur::where('statut', false)->count();
        
        // Statistiques des assignations
        $totalAssignations = Assignation::count();
        $assignationsSemaine = Assignation::whereBetween('date_assignation', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        $assignationsMoisEnCours = Assignation::whereBetween('date_assignation', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();
        
        
        // Retourner la vue avec les données
        return view('dashboard', compact(
            'totalDonneurs',
            'donneursDisponibles',
            'totalReceveurs',
            'receveursEnAttente',
            'receveursUrgents',
            'receveursSatisfaits',
            'totalAssignations',
            'assignationsSemaine',
            'assignationsMoisEnCours',
            
        ));
    }
}