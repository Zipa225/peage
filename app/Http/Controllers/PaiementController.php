<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\CategorieVehicule;
use App\Models\TypePaiement;
use App\Models\SessionGuichet;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::with(['categorieVehicule', 'typePaiement', 'sessionGuichet.guichet', 'sessionGuichet.user'])->get();
        return view('admin.paiements.index', compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategorieVehicule::all();
        $types = TypePaiement::all();

        // Récupérer les tarifs actifs
        $tarifs = Tarif::whereNull('date_fin')->orWhere('date_fin', '>', now())->get();

        // Session active de l'agent connecté
        $sessionId = session('session_guichet_id');
        $sessionActive = SessionGuichet::with(['guichet', 'user'])
            ->where('id', $sessionId)
            ->where('statut', 'ouverte')
            ->first();

        return view('admin.paiements.create', compact('categories', 'types', 'tarifs', 'sessionActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant'               => 'required|numeric|min:0',
            'immatriculation'       => 'nullable|string|max:50',
            'categorie_vehicule_id' => 'required|exists:categorie_vehicule,id',
            'type_paiement_id'      => 'required|exists:type_paiement,id',
            'statut'                => 'nullable|string|max:50',
        ]);

        // Récupérer la session active depuis la session HTTP
        $sessionId = session('session_guichet_id');

        if (! $sessionId) {
            return redirect()->route('admin.session.ouvrir')
                ->withErrors(['session' => 'Aucune session guichet active. Veuillez ouvrir une session.']);
        }

        $paiement = Paiement::create([
            'date_paiement'         => now(),
            'montant'               => $request->montant,
            'immatriculation'       => $request->immatriculation,
            'categorie_vehicule_id' => $request->categorie_vehicule_id,
            'type_paiement_id'      => $request->type_paiement_id,
            'session_guichet_id'    => $sessionId,
            'statut'                => $request->statut ?? 'valide',
        ]);

        return redirect()->route('admin.paiements.show', ['paiement' => $paiement->id, 'print' => 1])
            ->with('success', 'Paiement enregistré avec succès.')
            ->with('print', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paiement = Paiement::with(['categorieVehicule', 'typePaiement', 'sessionGuichet.guichet', 'sessionGuichet.user'])->findOrFail($id);
        return view('admin.paiements.show', compact('paiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paiement = Paiement::with('sessionGuichet.guichet')->findOrFail($id);
        $categories = CategorieVehicule::all();
        $types = TypePaiement::all();
        $tarifs = Tarif::whereNull('date_fin')->orWhere('date_fin', '>', now())->get();
        return view('admin.paiements.edit', compact('paiement', 'categories', 'types', 'tarifs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'montant'               => 'required|numeric|min:0',
            'immatriculation'       => 'nullable|string|max:50',
            'categorie_vehicule_id' => 'required|exists:categorie_vehicule,id',
            'type_paiement_id'      => 'required|exists:type_paiement,id',
            'statut'                => 'nullable|string|max:50',
        ], [
            'montant.required'               => 'Le montant est obligatoire.',
            'montant.numeric'                => 'Le montant doit être un nombre.',
            'montant.min'                    => 'Le montant doit être au moins 0.',
            'categorie_vehicule_id.required' => 'La catégorie de véhicule est obligatoire.',
            'categorie_vehicule_id.exists'   => 'La catégorie sélectionnée est invalide.',
            'type_paiement_id.required'      => 'Le type de paiement est obligatoire.',
            'type_paiement_id.exists'        => 'Le type de paiement sélectionné est invalide.',
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->only(['montant', 'immatriculation', 'categorie_vehicule_id', 'type_paiement_id', 'statut']));

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Paiement supprimé avec succès.');
    }
}
