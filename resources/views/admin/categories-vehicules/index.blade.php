@extends('layouts.admin')

@section('title', 'Catégories')

@section('page-title')
    <h1>Catégories de Véhicules</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.categories-vehicules.create') }}" style="background: var(--color-light); color: white; padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">add</span>
            Nouvelle catégorie
        </a>
    </div>

    <div class="passages-recents">
        <h2>Référentiel des catégories</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td><b>{{ $cat->libelle }}</b></td>
                    <td>
                        <a href="{{ route('admin.categories-vehicules.edit', $cat->id) }}"><span class="material-icons-sharp" style="color: var(--color-waring);">edit</span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
