<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Donneur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord
     */
    public function index()
    {
        // Statistiques de base
        $totalDonneurs = Donneur::count();
        $donneursDisponibles = Donneur::where('disponible', true)->count();
        
        // Dons ce mois
        $donsCeMois = Donneur::where('dernier_don', '>=', now()->startOfMonth())->count();
                
        // Statistiques par groupe sanguin
        $groupesSanguins = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $statsGroupes = [];
        
        foreach ($groupesSanguins as $groupe) {
            $count = Donneur::where('groupe_sanguin', $groupe)->count();
            $total = $totalDonneurs > 0 ? $totalDonneurs : 1;
            $percentage = ($count / $total) * 100;
            
            $statsGroupes[$groupe] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        // Retourner la vue avec les données
        return view('dashboard', compact(
            'totalDonneurs',
            'donneursDisponibles',
            'donsCeMois',
            'statsGroupes'
        ));
    }
}