@extends('layouts.admin')

@section('title', 'Modifier Tarif')

@section('page-title')
    <h1>Modifier le tarif</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.tarifs.update', $tarif->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Catégorie de véhicule</label>
                    <select name="categorie_vehicule_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-background); color: var(--color-dark);">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $tarif->categorie_vehicule_id == $cat->id ? 'selected' : '' }}>{{ $cat->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Montant (F CFA)</label>
                    <input type="number" name="montant" value="{{ old('montant', $tarif->montant) }}" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-background); color: var(--color-dark);">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Date de début</label>
                        <input type="date" name="date_debut" value="{{ old('date_debut', \Carbon\Carbon::parse($tarif->date_debut)->format('Y-m-d')) }}" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-background); color: var(--color-dark);">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Date de fin</label>
                        <input type="date" name="date_fin" value="{{ old('date_fin', $tarif->date_fin ? \Carbon\Carbon::parse($tarif->date_fin)->format('Y-m-d') : '') }}" style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-background); color: var(--color-dark);">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-submit">Mettre à jour</button>
                    <a href="{{ route('admin.tarifs.index') }}" style="padding: 0.8rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light); display: inline-flex; align-items: center;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
