@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="logo">
            <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo">
            <h2>S <span class="danger">M</span></h2>
        </div>
        <h2>Bienvenue</h2>
        <p class="text-muted">Connectez-vous à votre compte</p>

        @if(session('error'))
            <p style="color: var(--color-danger); margin-bottom: 1rem;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
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

            <div class="options">
                <label><input type="checkbox" name="remember"> Se souvenir de moi</label>
                <a href="{{ route('password.request') }}" class="primary">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-login">Se Connecter</button>

            <div class="register-link">
                <p>Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="primary">Créer un compte</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
