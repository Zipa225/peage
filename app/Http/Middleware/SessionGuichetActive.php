<?php

namespace App\Http\Middleware;

use App\Models\SessionGuichet;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionGuichetActive
{
    /**
     * Vérifie que l'agent a bien une session guichet ouverte.
     * Sinon, le redirige vers l'écran d'ouverture de session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionId = session('session_guichet_id');

        // Vérification en base (anti-falsification de session)
        if ($sessionId) {
            $sessionValide = SessionGuichet::where('id', $sessionId)
                ->where('user_id', Auth::id())
                ->where('statut', 'ouverte')
                ->exists();

            if ($sessionValide) {
                return $next($request);
            }

            // Session en base fermée/invalide → nettoyer la session HTTP
            session()->forget('session_guichet_id');
        }

        return redirect()->route('admin.session.ouvrir')
            ->with('warning', 'Vous devez ouvrir une session guichet avant de pouvoir encaisser.');
    }
}
