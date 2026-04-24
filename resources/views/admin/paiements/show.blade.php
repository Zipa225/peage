@extends('layouts.admin')

@section('title', 'Détails Paiement')

@section('page-title')
    <h1>Reçu de Paiement #{{ $paiement->id }}</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: 2rem; border-radius: var(--border-radius-2); box-shadow: var(--box-shadow); position: relative; overflow: hidden;">
            
            {{-- Filigrane pour l'aspect "Reçu" --}}
            <div style="position: absolute; top: -20px; right: -20px; opacity: 0.1;">
                <span class="material-icons-sharp" style="font-size: 15rem; color: var(--color-success);">receipt_long</span>
            </div>

            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="color: var(--color-light);">PÉAGE MUNICIPAL</h2>
                <p class="text-muted">Reçu de passage sécurisé</p>
                <hr style="border: 0; border-top: 1px dashed var(--color-info-light); margin: 1.5rem 0;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <small class="text-muted">Date & Heure</small>
                    <p><b>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i:s') }}</b></p>
                </div>
                <div>
                    <small class="text-muted">Guichet</small>
                    <p><b>{{ $paiement->guichet->code ?? 'N/A' }}</b></p>
                </div>
                <div>
                    <small class="text-muted">Véhicule (Matricule)</small>
                    <p class="warning"><b>{{ $paiement->immatriculation ?? 'NON RENSEIGNÉ' }}</b></p>
                </div>
                <div>
                    <small class="text-muted">Catégorie</small>
                    <p><b>{{ $paiement->categorieVehicule->libelle ?? 'N/A' }}</b></p>
                </div>
                <div>
                    <small class="text-muted">Mode de paiement</small>
                    <p><b>{{ $paiement->typePaiement->libelle ?? 'N/A' }}</b></p>
                </div>
                <div>
                    <small class="text-muted">Agent</small>
                    <p><b>{{ $paiement->user->prenoms ?? 'N/A' }}</b></p>
                </div>
            </div>

            <div style="margin-top: 3rem; background: var(--color-background); padding: 1.5rem; border-radius: var(--border-radius-1); text-align: center;">
                <small class="text-muted">MONTANT TOTAL PAYÉ</small>
                <h1 style="font-size: 2.5rem; color: var(--color-dark);">{{ number_format($paiement->montant, 0, ',', ' ') }} F CFA</h1>
            </div>

            <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center;">
                <button onclick="window.print()" class="btn-submit" style="background: var(--color-dark); display: flex; align-items: center; gap: 0.5rem;">
                    <span class="material-icons-sharp">print</span> Imprimer
                </button>
                <a href="{{ route('admin.paiements.index') }}" style="padding: 0.8rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light); display: inline-flex; align-items: center;">Retour</a>
            </div>
        </div>
    </div>
@endsection
