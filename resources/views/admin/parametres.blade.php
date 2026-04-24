@extends('layouts.admin')

@section('title', 'Paramètres')

@section('page-title')
    <h1>Paramètres du Système</h1>
@endsection

@section('content')
    <div class="passages-recents">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <h2>Informations du compte</h2>
            <div style="margin-top: 1rem;">
                <p><b>Nom :</b> {{ Auth::user()->nom }}</p>
                <p><b>Prénoms :</b> {{ Auth::user()->prenoms }}</p>
                <p><b>Email :</b> {{ Auth::user()->email }}</p>
                <p><b>Rôle :</b> Administrateur</p>
            </div>
            <br>
            <a href="{{ route('admin.users.edit', Auth::id()) }}" style="background: var(--color-light); color: white; padding: 0.8rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; font-weight: 600;">Modifier mon profil</a>
        </div>
    </div>
@endsection
