@extends('layouts.admin')

@section('title', 'Tarifs')

@section('page-title')
    <h1>Grille Tarifaire</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.tarifs.create') }}" style="background: var(--color-light); color: white; padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">add_circle</span>
            Ajouter un tarif
        </a>
    </div>

    <div class="passages-recents">
        <h2>Tarifs par catégorie</h2>
        <table>
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Montant</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarifs as $tarif)
                <tr>
                    <td><b>{{ $tarif->categorieVehicule->libelle ?? '—' }}</b></td>
                    <td class="success">{{ number_format($tarif->montant, 0, ',', ' ') }} F</td>
                    <td>{{ \Carbon\Carbon::parse($tarif->date_debut)->format('d/m/Y') }}</td>
                    <td>{{ $tarif->date_fin ? \Carbon\Carbon::parse($tarif->date_fin)->format('d/m/Y') : 'En vigueur' }}</td>
                    <td style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ route('admin.tarifs.edit', $tarif->id) }}"><span class="material-icons-sharp" style="color: var(--color-waring);">edit</span></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Aucun tarif configuré</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
