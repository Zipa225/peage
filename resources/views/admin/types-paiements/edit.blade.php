@extends('layouts.admin')

@section('title', 'Modifier Mode de Paiement')

@section('page-title')
    <h1>Modifier le mode de paiement</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.types-paiements.update', $typePaiement->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Nom du mode de paiement</label>
                    <input type="text" name="libelle" value="{{ old('libelle', $typePaiement->libelle) }}" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-background); color: var(--color-dark);">
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-submit">Mettre à jour</button>
                    <a href="{{ route('admin.types-paiements.index') }}" style="padding: 0.8rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light); display: inline-flex; align-items: center;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
