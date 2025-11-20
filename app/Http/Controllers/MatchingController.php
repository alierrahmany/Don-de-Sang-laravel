<?php

namespace App\Http\Controllers;

use App\Models\Donneur;
use App\Models\Receveur;
use App\Models\Assignation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MatchingController extends Controller
{
    // Règles de compatibilité sanguine
    private $compatibiliteSanguine = [
        'A+' => ['A+', 'A-', 'O+', 'O-'],
        'A-' => ['A-', 'O-'],
        'B+' => ['B+', 'B-', 'O+', 'O-'],
        'B-' => ['B-', 'O-'],
        'AB+' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
        'AB-' => ['A-', 'B-', 'AB-', 'O-'],
        'O+' => ['O+', 'O-'],
        'O-' => ['O-']
    ];

    public function index()
    {
        $receveurs = Receveur::where('statut', true)
            ->orderBy('urgence', 'desc')
            ->orderBy('date_urgence', 'asc')
            ->paginate(1);

        $matches = [];

        foreach ($receveurs as $receveur) {
            $donneursCompatibles = $this->getDonneursCompatibles($receveur);

            $matches[$receveur->id] = [
                'receveur' => $receveur,
                'donneurs_compatibles' => $donneursCompatibles,
                'nombre_compatibles' => $donneursCompatibles->count()
            ];
        }

        // Trier par urgence et nombre de compatibles
        uasort($matches, function($a, $b) {
            if ($a['receveur']->urgence && !$b['receveur']->urgence) return -1;
            if (!$a['receveur']->urgence && $b['receveur']->urgence) return 1;
            return $a['nombre_compatibles'] <=> $b['nombre_compatibles'];
        });

        return view('matching.index', compact(
            'receveurs',
            'matches'
        ));
    }

    private function getDonneursCompatibles($receveur)
    {
        return Donneur::where('disponible', true)
            ->whereIn('groupe_sanguin', $this->compatibiliteSanguine[$receveur->groupe_sanguin] ?? [])
            ->where(function($query) use ($receveur) {
                $query->where('ville', $receveur->ville)
                      ->orWhereNotNull('ville');
            })
            ->where(function($query) {
                $query->whereNull('dernier_don')
                      ->orWhere('dernier_don', '<=', Carbon::now()->subMonths(3));
            })
            ->orderByRaw("CASE WHEN ville = ? THEN 0 ELSE 1 END", [$receveur->ville])
            ->orderBy('dernier_don', 'asc')
            ->get();
    }

    public function assignerDonneur(Request $request)
    {
        $request->validate([
            'receveur_id' => 'required|exists:receveurs,id',
            'donneur_id' => 'required|exists:donneurs,id'
        ]);

        try {
            DB::beginTransaction();

            $donneur = Donneur::findOrFail($request->donneur_id);
            $receveur = Receveur::findOrFail($request->receveur_id);

            // Vérifier si l'assignation existe déjà
            $assignationExistante = Assignation::where('receveur_id', $request->receveur_id)
                ->where('donneur_id', $request->donneur_id)
                ->first();

            if ($assignationExistante) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette assignation existe déjà.'
                ]);
            }

            // Vérifier la disponibilité du donneur
            if (!$donneur->disponible) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce donneur n\'est plus disponible.'
                ]);
            }

            // Vérifier si le donneur est éligible pour un nouveau don
            if (!$donneur->est_disponible_pour_don) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce donneur n\'est pas éligible pour un nouveau don (doit attendre 3 mois après le dernier don).'
                ]);
            }

            // Vérifier le statut du receveur
            if (!$receveur->statut) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce receveur a déjà été satisfait.'
                ]);
            }

            // Vérifier la compatibilité sanguine
            $groupesCompatibles = $this->compatibiliteSanguine[$receveur->groupe_sanguin] ?? [];
            if (!in_array($donneur->groupe_sanguin, $groupesCompatibles)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Incompatibilité sanguine entre le donneur et le receveur.'
                ]);
            }

            // Créer l'assignation
            Assignation::create([
                'receveur_id' => $request->receveur_id,
                'donneur_id' => $request->donneur_id,
                'date_assignation' => now(),
                'statut' => 'assigné',
                'notes' => 'Assignation automatique via matching'
            ]);

            // Marquer le donneur comme indisponible
            $donneur->update(['disponible' => false]);

            // Marquer le receveur comme satisfait
            $receveur->update(['statut' => false]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Donneur assigné avec succès au receveur.',
                'redirect_url' => route('matching.historique')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erreur lors de l\'assignation: ' . $e->getMessage(), [
                'receveur_id' => $request->receveur_id,
                'donneur_id' => $request->donneur_id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'assignation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function historique()
    {
        $assignations = Assignation::with(['receveur', 'donneur'])
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('matching.historique', compact('assignations'));
    }

    public function showAssignation($id)
    {
        $assignation = Assignation::with(['receveur', 'donneur'])->findOrFail($id);
        
        return view('matching.show', compact('assignation'));
    }
}