<?php

namespace App\Http\Controllers;

use App\Models\Receveur;
use Illuminate\Http\Request;

class ReceveurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receveurs = Receveur::latest()->get();
        return view('receveurs.index', compact('receveurs'));
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
            'besoin_medical' => 'nullable|string',
            'date_urgence' => 'nullable|date',
            'urgence' => 'boolean',
        ]);

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
            'besoin_medical' => 'nullable|string',
            'date_urgence' => 'nullable|date',
            'urgence' => 'boolean',
            'statut' => 'boolean',
        ]);

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

        return back()->with('success', 'Statut d\'urgence mis à jour!');
    }

    /**
     * Marquer comme satisfait
     */
    public function markAsSatisfied(Receveur $receveur)
    {
        $receveur->update(['statut' => false]);

        return back()->with('success', 'Receveur marqué comme satisfait!');
    }
}