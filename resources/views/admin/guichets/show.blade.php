@extends('layouts.admin')

@section('title', 'Guichet ' . $guichet->code)

@section('page-title')
    <h1>Guichet {{ $guichet->code }}</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.guichets.index') }}" style="padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light); display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="insights" style="margin-top: 1rem;">
        <div class="sale">
            <span class="material-icons-sharp">tag</span>
            <div class="middle">
                <div class="left">
                    <h3>Code</h3>
                    <h1>{{ $guichet->code }}</h1>
                </div>
            </div>
        </div>

        <div class="{{ $guichet->statut === 'actif' ? 'income' : 'dysfunction' }}">
            <span class="material-icons-sharp">{{ $guichet->statut === 'actif' ? 'check_circle' : 'cancel' }}</span>
            <div class="middle">
                <div class="left">
                    <h3>Statut</h3>
                    <h1>{{ ucfirst($guichet->statut ?? 'Non défini') }}</h1>
                </div>
            </div>
        </div>

        <div class="sale">
            <span class="material-icons-sharp">payments</span>
            <div class="middle">
                <div class="left">
                    <h3>Paiements</h3>
                    <h1>{{ $guichet->paiements->count() }}</h1>
                </div>
            </div>
        </div>
    </div>

    @if($guichet->paiements->count() > 0)
    <div class="passages-recents" style="margin-top: 2rem;">
        <h2>Derniers paiements sur ce guichet</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Matricule</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guichet->paiements->sortByDesc('date_paiement')->take(10) as $paiement)
                <tr>
                    <td>{{ $paiement->date_paiement ? \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i') : '—' }}</td>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }}F CFA</td>
                    <td class="warning">{{ $paiement->immatriculation ?? '—' }}</td>
                    <td>{{ $paiement->typePaiement->libelle ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection
