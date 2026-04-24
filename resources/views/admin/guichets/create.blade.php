@extends('layouts.admin')

@section('title', 'Ajouter un guichet')

@section('page-title')
    <h1>Ajouter un guichet</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <h2>Nouveau guichet</h2>
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.guichets.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="code" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Code du guichet *</label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="Ex: A1, B2..." required
                        style="width: 100%; padding: 0.8rem 1rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark); font-size: 1rem;">
                    @error('code')
                        <small style="color: var(--color-danger);">{{ $message }}</small>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="statut" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Statut</label>
                    <select name="statut" id="statut"
                        style="width: 100%; padding: 0.8rem 1rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark); font-size: 1rem;">
                        <option value="actif" {{ old('statut') === 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('statut') === 'inactif' ? 'selected' : '' }}>Inactif</option>
                        <option value="maintenance" {{ old('statut') === 'maintenance' ? 'selected' : '' }}>En maintenance</option>
                    </select>
                    @error('statut')
                        <small style="color: var(--color-danger);">{{ $message }}</small>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit"
                        style="background: var(--color-light); color: white; padding: 0.8rem 2rem; border-radius: var(--border-radius-1); cursor: pointer; font-size: 1rem; font-weight: 600; border: none;">
                        <span class="material-icons-sharp" style="vertical-align: middle; margin-right: 0.3rem;">save</span>
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.guichets.index') }}"
                        style="padding: 0.8rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light); display: inline-flex; align-items: center;">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
