@extends('layouts.auth')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="logo">
            <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo">
            <h2>S <span class="danger">M</span></h2>
        </div>
        <h2>Mot de passe oublié ?</h2>
        <p class="text-muted">Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>

        @if(session('status'))
            <p style="color: var(--color-success); margin-bottom: 1rem;">{{ session('status') }}</p>
        @endif

        <form action="{{ route('password.request') }}" method="POST">
            @csrf
            <div class="input-group">
                <span class="material-icons-sharp">email</span>
                <input type="email" name="email" placeholder="Adresse Email" value="{{ old('email') }}" required>
            </div>
            @error('email')
                <small style="color: var(--color-danger); text-align: left; display: block;">{{ $message }}</small>
            @enderror

            <button type="submit" class="btn-login">Envoyer le lien</button>

            <div class="register-link">
                <p><a href="{{ route('login') }}" class="primary">Retour à la connexion</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
