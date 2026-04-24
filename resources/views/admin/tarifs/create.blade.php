@extends('layouts.admin')

@section('title', 'Nouveau Tarif')

@section('page-title')
    <h1>Ajouter un tarif</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.tarifs.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Catégorie de véhicule</label>
                    <select name="categorie_vehicule_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Montant (F CFA)</label>
                    <input type="number" name="montant" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Date de début</label>
                        <input type="date" name="date_debut" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Date de fin (optionnel)</label>
                        <input type="date" name="date_fin" style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" style="background: var(--color-light); color: white; padding: 0.8rem 2rem; border-radius: var(--border-radius-1); cursor: pointer; border: none; font-weight: 600;">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
