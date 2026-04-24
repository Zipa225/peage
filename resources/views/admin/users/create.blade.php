@extends('layouts.admin')

@section('title', 'Ajouter un utilisateur')

@section('page-title')
    <h1>Nouveau compte</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Prénoms</label>
                        <input type="text" name="prenoms" value="{{ old('prenoms') }}" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Mot de passe</label>
                    <input type="password" name="password" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" style="background: var(--color-light); color: white; padding: 0.8rem 2rem; border-radius: var(--border-radius-1); cursor: pointer; border: none; font-weight: 600;">Enregistrer</button>
                    <a href="{{ route('admin.users.index') }}" style="padding: 0.8rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light);">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
