<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Guichet;
use App\Models\User;
use App\Models\CategorieVehicule;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord principal.
     */
    public function index()
    {
        $totalPaiements = Paiement::count();
        $totalRevenu = Paiement::where('statut', 'valide')->sum('montant');
        $totalGuichets = Guichet::count();
        $guichetsActifs = Guichet::where('statut', 'actif')->count();
        $totalUsers = User::count();
        $totalCategories = CategorieVehicule::count();

        $passagesRecents = Paiement::with(['categorieVehicule', 'guichet', 'typePaiement', 'user'])
            ->latest('date_paiement')
            ->take(10)
            ->get();

        // Revenus des dernières 24h
        $revenu24h = Paiement::where('statut', 'valide')
            ->where('date_paiement', '>=', now()->subDay())
            ->sum('montant');

        // Paiements des dernières 24h
        $paiements24h = Paiement::where('date_paiement', '>=', now()->subDay())->count();

        return view('admin.dashboard', compact(
            'totalPaiements',
            'totalRevenu',
            'totalGuichets',
            'guichetsActifs',
            'totalUsers',
            'totalCategories',
            'passagesRecents',
            'revenu24h',
            'paiements24h'
        ));
    }
}
