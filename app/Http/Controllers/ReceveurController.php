<?php

namespace App\Http\Controllers;

use App\Models\Receveur;
use Illuminate\Http\Request;

class ReceveurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Appliquer les filtres
        $query = $this->applyFilters(Receveur::query(), $request);
        
 

        // Récupérer les receveurs avec pagination
        $receveurs = $query->latest()->paginate(4);

       


        // Villes uniques pour le filtre
        $villes = Receveur::select('ville')->distinct()->orderBy('ville')->pluck('ville');

        return view('receveurs.index', compact(
            'receveurs', 
            
            'villes'
        ));
    }

    /**
     * Applique les filtres à la query
     */
    private function applyFilters($query, Request $request)
    {
        // Filtre par groupe sanguin
        if ($request->filled('groupe_sanguin')) {
            $query->where('groupe_sanguin', $request->groupe_sanguin);
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par urgence
        if ($request->filled('urgence')) {
            $query->where('urgence', $request->urgence);
        }

        // Filtre par ville
        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        // Filtre par recherche (nom, prénom, email)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('prenom', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('telephone', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }

   


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('receveurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:receveurs,email',
            'telephone' => 'required|string|max:20',
            'ville' => 'required|string|max:255',
            'groupe_sanguin' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'besoin_medical' => 'nullable|string|max:500',
            'date_urgence' => 'nullable|date|after_or_equal:today',
            'urgence' => 'sometimes|boolean',
        ], [
            'email.unique' => 'Cet email est déjà utilisé par un autre receveur.',
            'groupe_sanguin.in' => 'Le groupe sanguin sélectionné est invalide.',
            'date_urgence.after_or_equal' => 'La date d\'urgence ne peut pas être dans le passé.',
        ]);

        // Assurer que urgence est un boolean
        $validated['urgence'] = $request->boolean('urgence');
        $validated['statut'] = true; // Par défaut en attente

        Receveur::create($validated);

        return redirect()->route('receveurs.index')
            ->with('success', 'Receveur ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receveur $receveur)
    {
        return view('receveurs.show', compact('receveur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receveur $receveur)
    {
        return view('receveurs.edit', compact('receveur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receveur $receveur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:receveurs,email,' . $receveur->id,
            'telephone' => 'required|string|max:20',
            'ville' => 'required|string|max:255',
            'groupe_sanguin' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'besoin_medical' => 'nullable|string|max:500',
            'date_urgence' => 'nullable|date|after_or_equal:today',
            'urgence' => 'sometimes|boolean',
            'statut' => 'sometimes|boolean',
        ], [
            'email.unique' => 'Cet email est déjà utilisé par un autre receveur.',
            'groupe_sanguin.in' => 'Le groupe sanguin sélectionné est invalide.',
            'date_urgence.after_or_equal' => 'La date d\'urgence ne peut pas être dans le passé.',
        ]);

        // Assurer que les boolean sont corrects
        $validated['urgence'] = $request->boolean('urgence');
        $validated['statut'] = $request->boolean('statut');

        $receveur->update($validated);

        return redirect()->route('receveurs.index')
            ->with('success', 'Receveur modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receveur $receveur)
    {
        $receveur->delete();

        return redirect()->route('receveurs.index')
            ->with('success', 'Receveur supprimé avec succès!');
    }

    /**
     * Toggle le statut d'urgence
     */
    public function toggleUrgence(Receveur $receveur)
    {
        $receveur->update(['urgence' => !$receveur->urgence]);

        $message = $receveur->urgence ? 'marqué comme urgent' : 'retiré des urgences';
        
        return back()->with('success', "Receveur {$message}!");
    }

    /**
     * Marquer comme satisfait
     */
    public function markAsSatisfied(Receveur $receveur)
    {
        $receveur->update(['statut' => false]);

        return back()->with('success', 'Receveur marqué comme satisfait!');
    }

    /**
     * Marquer comme en attente
     */
    public function markAsPending(Receveur $receveur)
    {
        $receveur->update(['statut' => true]);

        return back()->with('success', 'Receveur marqué comme en attente!');
    }
}