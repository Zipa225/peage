@extends('layouts.admin')

@section('title', 'Reçu de Paiement')

@section('page-title')
    <h1>Reçu de Paiement</h1>
@endsection

@section('content')
<style>
    @media print {
        aside, .main-header, .btn-no-print {
            display: none !important;
        }
        .container {
            display: block;
            width: 100%;
        }
        main {
            margin: 0;
            padding: 0;
        }
        .receipt-card {
            box-shadow: none !important;
            border: 1px solid #eee;
            width: 80mm; /* Largeur standard ticket thermique */
            margin: 0 auto;
        }
    }

    .receipt-card {
        background: #fff;
        width: 100%;
        max-width: 450px;
        margin: 1rem auto;
        padding: 2rem;
        border-radius: var(--border-radius-2);
        box-shadow: var(--box-shadow);
        font-family: 'Courier New', Courier, monospace; /* Police style ticket */
        color: #000;
    }

    .receipt-header {
        text-align: center;
        border-bottom: 2px dashed #eee;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .receipt-header h2 {
        margin: 0;
        font-size: 1.6rem;
        letter-spacing: 2px;
    }

    .receipt-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
    }

    .receipt-footer {
        text-align: center;
        border-top: 2px dashed #eee;
        padding-top: 1rem;
        margin-top: 1.5rem;
        font-size: 0.85rem;
    }

    .barcode {
        height: 60px;
        width: 100%;
        background: repeating-linear-gradient(90deg, #000, #000 2px, #fff 2px, #fff 4px);
        margin: 1rem 0;
    }

    .total-box {
        background: #000;
        color: #fff;
        padding: 1rem;
        text-align: center;
        margin: 1.5rem 0;
        border-radius: var(--border-radius-1);
    }
</style>

<div class="receipt-card">
    <div class="receipt-header">
        <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo" style="width: 50px; margin-bottom: 0.5rem;">
        <h2>AUTOROUTE CI</h2>
        <p>SOCIÉTÉ DE GESTION DU PÉAGE</p>
        <p>GUICHET : <strong>{{ $paiement->sessionGuichet?->guichet?->code ?? 'N/A' }}</strong></p>
    </div>

    <div class="receipt-body">
        <div class="receipt-row">
            <span>TICKET N°:</span>
            <strong>#{{ str_pad($paiement->id, 8, '0', STR_PAD_LEFT) }}</strong>
        </div>
        <div class="receipt-row">
            <span>DATE:</span>
            <strong>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i') }}</strong>
        </div>
        <div class="receipt-row">
            <span>CLASSE:</span>
            <strong>{{ $paiement->categorieVehicule->libelle ?? 'N/A' }}</strong>
        </div>
        <div class="receipt-row">
            <span>MATRICULE:</span>
            <strong>{{ $paiement->immatriculation ?? '---' }}</strong>
        </div>
        <div class="receipt-row">
            <span>MODE PAIEMENT:</span>
            <strong>{{ $paiement->typePaiement->libelle ?? 'ESPÈCES' }}</strong>
        </div>
        <div class="receipt-row">
            <span>AGENT:</span>
            <strong>{{ strtoupper($paiement->sessionGuichet?->user?->nom ?? 'ADMIN') }}</strong>
        </div>

        <div class="total-box">
            <p style="margin-bottom: 0.2rem; font-size: 0.8rem; opacity: 0.8;">TOTAL PAYÉ</p>
            <h1 style="margin: 0; font-size: 2rem;">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</h1>
        </div>

        <div class="barcode"></div>
    </div>

    <div class="receipt-footer">
        <p>MERCI DE VOTRE PASSAGE</p>
        <p>BONNE ROUTE ET SOYEZ PRUDENT</p>
        <p style="margin-top: 0.5rem; font-size: 0.7rem;">SGP - SYSTEM V1.0</p>
    </div>
</div>

<div style="text-align: center; margin-top: 2rem;" class="btn-no-print">
    <button onclick="window.print()" class="btn-submit" style="background: var(--color-dark); width: auto; padding: 1rem 3rem;">
        <span class="material-icons-sharp">print</span> Imprimer le ticket
    </button>
    <a href="{{ route('admin.paiements.create') }}" style="margin-left: 1rem; color: var(--color-light); font-weight: 600;">Nouveau passage</a>
</div>

@if(session('print') || request('print'))
<script>
    setTimeout(function() {
        window.print();
    }, 500);
</script>
@endif

@endsection
