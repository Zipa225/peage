@extends('layouts.auth')

@section('title', 'Ouverture de session')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="logo">
            <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo">
            <h2>S <span class="danger">M</span></h2>
        </div>
        <h2>Session de Guichet</h2>
        <p class="text-muted">Sélectionnez votre poste de travail pour commencer</p>

        {{-- Infos agent --}}
        <div style="background: var(--color-primary); padding: 1rem; border-radius: var(--border-radius-1); margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
            <span class="material-icons-sharp" style="color: var(--color-light);">account_circle</span>
            <div style="text-align: left;">
                <h4 style="margin: 0; color: var(--color-dark);">{{ Auth::user()->prenoms }} {{ Auth::user()->nom }}</h4>
                <small class="text-muted">Agent de péage</small>
            </div>
        </div>

        @if($errors->any())
            <div style="background: #fee2e2; border: 1px solid #ef4444; border-radius: var(--border-radius-1); padding: 1rem; margin-bottom: 1.5rem; text-align: left;">
                <ul style="list-style: none; color: #b91c1c; font-size: 0.9rem; margin: 0; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="material-icons-sharp" style="font-size: 1.1rem;">error_outline</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('warning'))
            <div style="background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--border-radius-1); padding: 1rem; margin-bottom: 1.5rem; text-align: left; display: flex; align-items: center; gap: 0.5rem; color: #92400e; font-size: 0.9rem;">
                <span class="material-icons-sharp" style="font-size: 1.1rem;">warning_amber</span>
                {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('admin.session.store') }}" method="POST">
            @csrf
            
            <div class="input-group" style="margin-bottom: 1.5rem;">
                <span class="material-icons-sharp">point_of_sale</span>
                <select name="guichet_id" required style="background: transparent; border: none; outline: none; width: 100%; color: var(--color-dark); font-size: 1rem; cursor: pointer;">
                    <option value="" disabled selected>Choisir un guichet</option>
                    @foreach($guichets as $g)
                        <option value="{{ $g->id }}" {{ old('guichet_id') == $g->id ? 'selected' : '' }}>
                            {{ $g->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-login" style="width: 100%;">Ouvrir la session</button>
        </form>

        <div class="register-link">
            <p>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: var(--color-danger); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <span class="material-icons-sharp" style="font-size: 1.2rem;">logout</span>
                    Se déconnecter
                </a>
            </p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
