<?php

namespace App\Http\Controllers;

use App\Models\Guichet;
use App\Models\SessionGuichet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionGuichetController extends Controller
{
    /**
     * Affiche l'écran de sélection du guichet pour ouvrir une session.
     */
    public function showOuvrir()
    {
        // Si l'agent a déjà une session ouverte, le rediriger vers l'encaissement
        $sessionActive = SessionGuichet::where('user_id', Auth::id())
            ->where('statut', 'ouverte')
            ->with(['guichet'])
            ->first();

        if ($sessionActive) {
            session(['session_guichet_id' => $sessionActive->id]);
            return redirect()->route('admin.paiements.create')
                ->with('info', 'Vous avez déjà une session ouverte sur le guichet ' . $sessionActive->guichet->code . '.');
        }

        $guichets = Guichet::all();
        return view('admin.session.ouvrir', compact('guichets'));
    }

    /**
     * Ouvre une session guichet pour l'agent connecté.
     * Règle métier : un seul agent actif par guichet, un seul guichet par agent.
     */
    public function ouvrir(Request $request)
    {
        $request->validate([
            'guichet_id' => 'required|exists:guichet,id',
        ], [
            'guichet_id.required' => 'Veuillez sélectionner un guichet.',
            'guichet_id.exists'   => 'Le guichet sélectionné est invalide.',
        ]);

        // Règle 1 : le guichet ne peut avoir qu'une seule session ouverte
        $guichetOccupe = SessionGuichet::where('guichet_id', $request->guichet_id)
            ->where('statut', 'ouverte')
            ->exists();

        if ($guichetOccupe) {
            return back()->withErrors([
                'guichet_id' => 'Ce guichet est déjà occupé par un autre agent. Veuillez en choisir un autre.',
            ])->withInput();
        }

        // Règle 2 : l'agent ne peut pas avoir deux sessions ouvertes simultanément
        $agentDejaEnSession = SessionGuichet::where('user_id', Auth::id())
            ->where('statut', 'ouverte')
            ->exists();

        if ($agentDejaEnSession) {
            return back()->withErrors([
                'guichet_id' => 'Vous avez déjà une session ouverte. Veuillez la fermer avant d\'en ouvrir une nouvelle.',
            ])->withInput();
        }

        // Création de la session
        $session = SessionGuichet::create([
            'user_id'        => Auth::id(),
            'guichet_id'     => $request->guichet_id,
            'date_ouverture' => now(),
            'statut'         => 'ouverte',
        ]);

        // Stocker la session_guichet_id dans la session HTTP pour persistance
        session(['session_guichet_id' => $session->id]);

        return redirect()->route('admin.paiements.create')
            ->with('success', 'Session ouverte avec succès sur le guichet ' . $session->guichet->code . '.');
    }

    /**
     * Ferme la session active de l'agent et affiche le récapitulatif.
     */
    public function fermer(Request $request)
    {
        $sessionId = session('session_guichet_id');

        $session = SessionGuichet::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->where('statut', 'ouverte')
            ->with(['guichet', 'user', 'paiements'])
            ->first();

        if (! $session) {
            session()->forget('session_guichet_id');
            return redirect()->route('admin.session.ouvrir')
                ->withErrors(['session' => 'Aucune session active trouvée.']);
        }

        // Calcul du récapitulatif AVANT fermeture
        $totalMontant       = $session->totalMontant();
        $nombreTransactions = $session->nombreTransactions();
        $guichetCode        = $session->guichet->code;
        $agentNom           = $session->user->prenoms . ' ' . $session->user->nom;

        // Mise à jour de la session en base
        $session->update([
            'date_fermeture' => now(),
            'statut'         => 'fermee',
        ]);

        // Supprimer la session_guichet_id du contexte HTTP
        session()->forget('session_guichet_id');

        return view('admin.session.recapitulatif', compact(
            'session',
            'totalMontant',
            'nombreTransactions',
            'guichetCode',
            'agentNom'
        ));
    }

    /**
     * Retourne (en JSON) la session active de l'agent — utile pour les appels AJAX.
     */
    public function sessionActive()
    {
        $sessionId = session('session_guichet_id');

        if (! $sessionId) {
            return response()->json(['session' => null], 200);
        }

        $session = SessionGuichet::with(['guichet', 'user'])
            ->where('id', $sessionId)
            ->where('statut', 'ouverte')
            ->first();

        return response()->json(['session' => $session]);
    }
}
