@extends('layouts.auth')

@section('title', 'Clôture de session')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="logo">
            <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo">
            <h2>S <span class="danger">M</span></h2>
        </div>
        <div style="margin-bottom: 2rem;">
            <div style="background: #dcfce7; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                <span class="material-icons-sharp" style="color: #15803d; font-size: 2.5rem;">task_alt</span>
            </div>
            <h2 style="margin-bottom: 0.2rem;">Session Clôturée</h2>
            <p class="text-muted">Voici le résumé de votre activité</p>
        </div>

        <div style="background: var(--color-primary); padding: 1.5rem; border-radius: var(--border-radius-2); margin-bottom: 2rem; text-align: left;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px solid var(--color-info-light); padding-bottom: 0.5rem;">
                <span class="text-muted">Guichet</span>
                <strong style="color: var(--color-dark);">{{ $guichetCode }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px solid var(--color-info-light); padding-bottom: 0.5rem;">
                <span class="text-muted">Agent</span>
                <strong style="color: var(--color-dark);">{{ $agentNom }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px solid var(--color-info-light); padding-bottom: 0.5rem;">
                <span class="text-muted">Transactions</span>
                <strong style="color: var(--color-dark);">{{ $nombreTransactions }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 1rem; align-items: center;">
                <span style="font-weight: 700; color: var(--color-dark);">TOTAL ENCAISSÉ</span>
                <span style="font-size: 1.4rem; font-weight: 800; color: var(--color-light);">{{ number_format($totalMontant, 0, ',', ' ') }} F</span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 2rem; text-align: left; font-size: 0.85rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-dark-variant);">
                <span class="material-icons-sharp" style="font-size: 1.1rem;">schedule</span>
                Ouvert : {{ \Carbon\Carbon::parse($session->date_ouverture)->format('d/m/Y H:i') }}
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-dark-variant);">
                <span class="material-icons-sharp" style="font-size: 1.1rem;">event_available</span>
                Fermé : {{ \Carbon\Carbon::parse($session->date_fermeture)->format('d/m/Y H:i') }}
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <a href="{{ route('admin.session.ouvrir') }}" class="btn-login" style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <span class="material-icons-sharp">refresh</span>
                Nouvelle Session
            </a>
            
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: var(--color-danger); font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 0.5rem;">
                <span class="material-icons-sharp" style="font-size: 1.2rem;">logout</span>
                Quitter l'application
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
