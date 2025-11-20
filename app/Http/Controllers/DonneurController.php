<?php
// app/Http/Controllers/DonneurController.php

namespace App\Http\Controllers;

use App\Models\Donneur;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DonneurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Donneur::query();
        
        // Recherche par nom, prénom ou email
        if ($request->filled('recherche')) {
            $searchTerm = $request->recherche;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nom', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('prenom', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Filtre par groupe sanguin
        if ($request->filled('groupe_sanguin')) {
            $query->where('groupe_sanguin', $request->groupe_sanguin);
        }
        
        // Filtre par disponibilité
        if ($request->filled('disponible')) {
            $query->where('disponible', $request->disponible);
        }
        
        // Filtre par ville
        if ($request->filled('ville')) {
            $query->where('ville', 'LIKE', "%{$request->ville}%");
        }
        
        $donneurs = $query->latest()->paginate(4);
        $groupesSanguins = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        
        // Calculer l'âge pour chaque donneur
        foreach ($donneurs as $donneur) {
            $donneur->age = Carbon::parse($donneur->date_naissance)->age;
        }
        
        return view('donneurs.index', compact('donneurs', 'groupesSanguins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupesSanguins = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        return view('donneurs.create', compact('groupesSanguins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:donneurs,email',
            'telephone' => 'required|string|max:20',
            'genre' => 'required|in:Homme,Femme',
            'groupe_sanguin' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'ville' => 'required|string|max:255',
            'date_naissance' => 'required|date|before:-18 years',
            'disponible' => 'boolean'
        ]);

        Donneur::create($validated);

        return redirect()->route('donneurs.index')
            ->with('success', 'Donneur ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donneur $donneur)
    {
        $groupesSanguins = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        return view('donneurs.edit', compact('donneur', 'groupesSanguins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donneur $donneur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:donneurs,email,' . $donneur->id,
            'telephone' => 'required|string|max:20',
            'genre' => 'required|in:Homme,Femme',
            'groupe_sanguin' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'ville' => 'required|string|max:255',
            'date_naissance' => 'required|date|before:-18 years',
            'disponible' => 'boolean'
        ]);

        $donneur->update($validated);

        return redirect()->route('donneurs.index')
            ->with('success', 'Donneur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donneur $donneur)
    {
        $donneur->delete();

        return redirect()->route('donneurs.index')
            ->with('success', 'Donneur supprimé avec succès.');
    }

    /**
     * Toggle donor availability
     */
    public function toggleDisponibilite(Donneur $donneur)
    {
        $donneur->update(['disponible' => !$donneur->disponible]);

        $message = $donneur->disponible 
            ? 'Donneur marqué comme disponible' 
            : 'Donneur marqué comme indisponible';

        return back()->with('success', $message);
    }

    /**
     * Enregistrer un don
     */
    public function enregistrerDon(Donneur $donneur)
    {
        // Vérifier si le donneur peut donner (délai de 3 mois)
        if ($donneur->dernier_don) {
            $dernierDon = Carbon::parse($donneur->dernier_don);
            $now = Carbon::now();
            
            if ($dernierDon->diffInMonths($now) < 3) {
                return back()->with('error', 'Ce donneur ne peut pas donner maintenant (délai de 3 mois non respecté).');
            }
        }

        $donneur->update([
            'dernier_don' => Carbon::now(),
            'disponible' => false
        ]);

        return back()->with('success', 'Don enregistré avec succès. Le donneur est maintenant indisponible.');
    }
}