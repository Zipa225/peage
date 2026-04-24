@extends('layouts.auth')

@section('title', 'Créer un compte')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="logo">
            <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo">
            <h2>S <span class="danger">M</span></h2>
        </div>
        <h2>Créer un compte</h2>
        <p class="text-muted">Rejoignez-nous dès aujourd'hui</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group">
                <span class="material-icons-sharp">badge</span>
                <input type="text" name="nom" placeholder="Nom" value="{{ old('nom') }}" required>
            </div>
            @error('nom')
                <small style="color: var(--color-danger); text-align: left; display: block;">{{ $message }}</small>
            @enderror

            <div class="input-group">
                <span class="material-icons-sharp">person</span>
                <input type="text" name="prenoms" placeholder="Prénoms" value="{{ old('prenoms') }}" required>
            </div>
            @error('prenoms')
                <small style="color: var(--color-danger); text-align: left; display: block;">{{ $message }}</small>
            @enderror

            <div class="input-group">
                <span class="material-icons-sharp">email</span>
                <input type="email" name="email" placeholder="Adresse Email" value="{{ old('email') }}" required>
            </div>
            @error('email')
                <small style="color: var(--color-danger); text-align: left; display: block;">{{ $message }}</small>
            @enderror

            <div class="input-group">
                <span class="material-icons-sharp">lock</span>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            @error('password')
                <small style="color: var(--color-danger); text-align: left; display: block;">{{ $message }}</small>
            @enderror

            <div class="input-group">
                <span class="material-icons-sharp">lock_outline</span>
                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
            </div>

            <button type="submit" class="btn-login">S'inscrire</button>

            <div class="register-link">
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}" class="primary">Se connecter</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
