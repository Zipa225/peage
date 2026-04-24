@extends('layouts.admin')

@section('title', 'Nouvelle Catégorie')

@section('page-title')
    <h1>Ajouter une catégorie</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.categories-vehicules.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Libellé de la catégorie</label>
                    <input type="text" name="libelle" placeholder="Ex: Moto, Véhicule léger, Poids lourd..." required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                </div>
                <button type="submit" style="background: var(--color-light); color: white; padding: 0.8rem 2rem; border-radius: var(--border-radius-1); cursor: pointer; border: none; font-weight: 600;">Créer la catégorie</button>
            </form>
        </div>
    </div>
@endsection
