@extends('layouts.admin')

@section('title', 'Paiements')

@section('page-title')
    <h1>Historique des Paiements</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.paiements.create') }}" style="background: var(--color-light); color: white; padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">add_card</span>
            Enregistrer un passage
        </a>
    </div>

    <div class="passages-recents">
        <h2>Transactions récentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Immatriculation</th>
                    <th>Catégorie</th>
                    <th>Montant</th>
                    <th>Guichet</th>
                    <th>Agent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i') }}</td>
                    <td class="warning">{{ $paiement->immatriculation ?? 'N/A' }}</td>
                    <td>{{ $paiement->categorieVehicule->libelle ?? '—' }}</td>
                    <td><b>{{ number_format($paiement->montant, 0, ',', ' ') }} F</b></td>
                    <td>{{ $paiement->sessionGuichet?->guichet?->code ?? '—' }}</td>
                    <td>{{ $paiement->sessionGuichet?->user?->prenoms ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.paiements.show', $paiement->id) }}"><span class="material-icons-sharp" style="color: var(--color-light);">visibility</span></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">Aucune transaction aujourd'hui</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
