@extends('layouts.admin')

@section('title', 'Nouveau Mode de Paiement')

@section('page-title')
    <h1>Ajouter un mode de paiement</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.types-paiements.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Nom du mode de paiement</label>
                    <input type="text" name="libelle" placeholder="Ex: Espèces, Orange Money, Wave..." required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                </div>
                <button type="submit" style="background: var(--color-light); color: white; padding: 0.8rem 2rem; border-radius: var(--border-radius-1); cursor: pointer; border: none; font-weight: 600;">Créer le mode de paiement</button>
            </form>
        </div>
    </div>
@endsection
