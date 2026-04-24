<?php

use Illuminate\Support\Facades\Route;

// Importation de tous les contrôleurs
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieVehiculeController;
use App\Http\Controllers\GuichetController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TypePaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionGuichetController;

// =============================================
// ROUTES AUTHENTIFICATION (publiques)
// =============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =============================================
// ROUTE FRONTEND (page d'accueil publique)
// =============================================
Route::get('/', function () {
    return redirect()->route('login');
});

// =============================================
// ROUTES BACKEND (protégées par auth)
// =============================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // =============================================
    // ROUTES SESSION GUICHET
    // =============================================
    Route::get('/session/ouvrir', [SessionGuichetController::class, 'showOuvrir'])->name('session.ouvrir');
    Route::post('/session/ouvrir', [SessionGuichetController::class, 'ouvrir'])->name('session.store');
    Route::post('/session/fermer', [SessionGuichetController::class, 'fermer'])->name('session.fermer');
    Route::get('/session/active', [SessionGuichetController::class, 'sessionActive'])->name('session.active');

    // =============================================
    // CRUD PAIEMENTS — protégés par SessionGuichetActive
    // =============================================
    Route::resource('paiements', PaiementController::class)->middleware('session.guichet');

    // =============================================
    // CRUD RESOURCES (Administration)
    // =============================================
    Route::resource('users', UserController::class);
    Route::resource('categories-vehicules', CategorieVehiculeController::class);
    Route::resource('guichets', GuichetController::class);
    Route::resource('tarifs', TarifController::class);
    Route::resource('types-paiements', TypePaiementController::class);

    // Pages spéciales
    Route::get('/analyse', function () {
        $paiements = \App\Models\Paiement::selectRaw('DATE(date_paiement) as jour, SUM(montant) as total, COUNT(*) as nombre')
            ->groupBy('jour')
            ->orderBy('jour', 'desc')
            ->take(7)
            ->get();

        $totalRevenu = \App\Models\Paiement::where('statut', 'valide')->sum('montant');
        $totalPaiements = \App\Models\Paiement::count();

        return view('admin.analyse', compact('paiements', 'totalRevenu', 'totalPaiements'));
    })->name('analyse');

    Route::get('/parametres', function () {
        return view('admin.parametres');
    })->name('parametres');

});
