<?php
// app/Http\Controllers\MatchingController.php

namespace App\Http\Controllers;

use App\Models\Donneur;
use App\Models\Receveur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MatchingController extends Controller
{
    /**
     * Display the matching between donors and receivers
     */
    public function index(Request $request)
    {
        // Récupérer les receveurs en attente
        $receveurs = Receveur::where('statut', true)
            ->when($request->filled('urgence'), function($query) use ($request) {
                return $query->where('urgence', $request->urgence);
            })
            ->when($request->filled('groupe_sanguin'), function($query) use ($request) {
                return $query->where('groupe_sanguin', $request->groupe_sanguin);
            })
            ->when($request->filled('ville'), function($query) use ($request) {
                return $query->where('ville', 'like', '%' . $request->ville . '%');
            })
            ->latest()
            ->paginate(10);

        // Pour chaque receveur, trouver les donneurs compatibles
        foreach ($receveurs as $receveur) {
            $receveur->donneurs_compatibles = $this->getDonneursCompatibles($receveur);
            $receveur->poches_restantes = $this->calculerPochesRestantes($receveur);
            $receveur->donneurs_compatibles_count = $receveur->donneurs_compatibles->count();
        }

        $groupesSanguins = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $villes = Receveur::select('ville')->distinct()->orderBy('ville')->pluck('ville');

        return view('matching.index', compact('receveurs', 'groupesSanguins', 'villes'));
    }

    /**
     * Get compatible donors for a receiver
     */
    private function getDonneursCompatibles(Receveur $receveur)
    {
        $groupeReceveur = $receveur->groupe_sanguin;
        
        // Règles de compatibilité sanguine
        $compatibilite = [
            'A+' => ['A+', 'A-', 'O+', 'O-'],
            'A-' => ['A-', 'O-'],
            'B+' => ['B+', 'B-', 'O+', 'O-'],
            'B-' => ['B-', 'O-'],
            'AB+' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
            'AB-' => ['A-', 'B-', 'AB-', 'O-'],
            'O+' => ['O+', 'O-'],
            'O-' => ['O-']
        ];

        $groupesCompatibles = $compatibilite[$groupeReceveur] ?? [];

        return Donneur::where('disponible', true)
            ->whereIn('groupe_sanguin', $groupesCompatibles)
            ->where('ville', $receveur->ville) // Même ville pour faciliter le don
            ->when($receveur->urgence, function($query) {
                return $query->orderBy('dernier_don', 'asc'); // Prioriser ceux qui n'ont pas donné depuis longtemps
            })
            ->limit(5) // Limiter à 5 donneurs pour ne pas surcharger l'affichage
            ->get();
    }

    /**
     * Calculate remaining blood bags needed
     */
    private function calculerPochesRestantes(Receveur $receveur)
    {
        // Simulation du calcul des poches restantes
        // En réalité, cela dépendrait des besoins médicaux spécifiques
        $besoinBase = 3; // Besoin de base en poches de sang
        
        // Ajuster selon l'urgence
        if ($receveur->urgence) {
            $besoinBase = 4;
        }
        
        // Réduire en fonction des donneurs compatibles disponibles
        $donneursDisponibles = $receveur->donneurs_compatibles->count();
        $pochesCouvertes = min($donneursDisponibles, $besoinBase);
        
        return max(0, $besoinBase - $pochesCouvertes);
    }

    /**
     * Determine urgency level based on receiver data
     */
    private function getNiveauUrgence(Receveur $receveur)
    {
        if ($receveur->urgence) {
            return $receveur->poches_restantes > 2 ? 'CRITIQUE' : 'URGENT';
        }
        return 'NORMAL';
    }

    /**
     * Export matching results to PDF
     */
    public function exportPDF(Request $request)
    {
        // Récupérer les données avec les mêmes filtres
        $receveurs = Receveur::where('statut', true)
            ->when($request->filled('urgence'), function($query) use ($request) {
                return $query->where('urgence', $request->urgence);
            })
            ->when($request->filled('groupe_sanguin'), function($query) use ($request) {
                return $query->where('groupe_sanguin', $request->groupe_sanguin);
            })
            ->when($request->filled('ville'), function($query) use ($request) {
                return $query->where('ville', 'like', '%' . $request->ville . '%');
            })
            ->get();

        // Préparer les données pour le PDF
        foreach ($receveurs as $receveur) {
            $receveur->donneurs_compatibles = $this->getDonneursCompatibles($receveur);
            $receveur->poches_restantes = $this->calculerPochesRestantes($receveur);
            $receveur->niveau_urgence = $this->getNiveauUrgence($receveur);
        }

        $data = [
            'receveurs' => $receveurs,
            'title' => 'Rapport de Matching Donneurs/Receveurs',
            'date' => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('matching.pdf', $data);
        
        return $pdf->download('matching-donneurs-receveurs-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Get matching statistics
     */
    public function getStats()
    {
        $totalReceveursEnAttente = Receveur::where('statut', true)->count();
        $receveursUrgents = Receveur::where('statut', true)->where('urgence', true)->count();
        $donneursDisponibles = Donneur::where('disponible', true)->count();

        return [
            'total_receveurs_attente' => $totalReceveursEnAttente,
            'receveurs_urgents' => $receveursUrgents,
            'donneurs_disponibles' => $donneursDisponibles,
        ];
    }
}