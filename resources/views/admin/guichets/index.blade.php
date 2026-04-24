@extends('layouts.admin')

@section('title', 'Guichets')

@section('page-title')
    <h1>Guichets</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.guichets.create') }}" style="background: var(--color-light); color: white; padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">add</span>
            Ajouter un guichet
        </a>
    </div>

    <div class="passages-recents">
        <h2>Liste des guichets</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Statut</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guichets as $guichet)
                <tr>
                    <td>{{ $guichet->id }}</td>
                    <td><b>{{ $guichet->code }}</b></td>
                    <td class="{{ $guichet->statut === 'actif' ? 'sucess' : 'danger' }}">
                        {{ ucfirst($guichet->statut ?? 'Non défini') }}
                    </td>
                    <td>{{ $guichet->created_at ? \Carbon\Carbon::parse($guichet->created_at)->format('d/m/Y H:i') : '—' }}</td>
                    <td style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ route('admin.guichets.show', $guichet->id) }}" title="Voir">
                            <span class="material-icons-sharp" style="color: var(--color-light);">visibility</span>
                        </a>
                        <a href="{{ route('admin.guichets.edit', $guichet->id) }}" title="Modifier">
                            <span class="material-icons-sharp" style="color: var(--color-waring);">edit</span>
                        </a>
                        <form action="{{ route('admin.guichets.destroy', $guichet->id) }}" method="POST" onsubmit="return confirm('Supprimer ce guichet ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; cursor: pointer;" title="Supprimer">
                                <span class="material-icons-sharp" style="color: var(--color-danger);">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Aucun guichet enregistré</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
