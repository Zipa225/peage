@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('page-title')
    <h1>Utilisateurs</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.users.create') }}" style="background: var(--color-light); color: white; padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">person_add</span>
            Ajouter un utilisateur
        </a>
    </div>

    <div class="passages-recents">
        <h2>Agents et Administrateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom & Prénoms</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td><b>{{ $user->prenoms }} {{ $user->nom }}</b></td>
                    <td>{{ $user->email }}</td>
                    <td><span class="text-muted">Agent</span></td>
                    <td style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ route('admin.users.show', $user->id) }}" title="Voir">
                            <span class="material-icons-sharp" style="color: var(--color-light);">visibility</span>
                        </a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" title="Modifier">
                            <span class="material-icons-sharp" style="color: var(--color-waring);">edit</span>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
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
                    <td colspan="4" style="text-align: center; padding: 2rem;">Aucun utilisateur enregistré</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
