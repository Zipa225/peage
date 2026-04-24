<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Péage') — Gestion de Péage</title>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <div class="container">

        {{-- ===== SIDEBAR ===== --}}
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="{{ asset('images/pngwing.com.png') }}" alt="Logo Péage">
                    <h2 style="margin-left: 10px;">S <span class="danger">M</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="{{ route('admin.paiements.index') }}" class="{{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}">
                    <span class="material-icons-sharp">payments</span>
                    <h3>Paiements</h3>
                </a>

                <a href="{{ route('admin.guichets.index') }}" class="{{ request()->routeIs('admin.guichets.*') ? 'active' : '' }}">
                    <span class="material-icons-sharp">account_balance_wallet</span>
                    <h3>Guichets</h3>
                </a>

                <a href="{{ route('admin.tarifs.index') }}" class="{{ request()->routeIs('admin.tarifs.*') ? 'active' : '' }}">
                    <span class="material-icons-sharp">sell</span>
                    <h3>Tarifs</h3>
                </a>

                <a href="{{ route('admin.categories-vehicules.index') }}" class="{{ request()->routeIs('admin.categories-vehicules.*') ? 'active' : '' }}">
                    <span class="material-icons-sharp">directions_car</span>
                    <h3>Catégories</h3>
                </a>

                <a href="{{ route('admin.types-paiements.index') }}" class="{{ request()->routeIs('admin.types-paiements.*') ? 'active' : '' }}">
                    <span class="material-icons-sharp">credit_card</span>
                    <h3>Types Paiement</h3>
                </a>

                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="material-icons-sharp">supervisor_account</span>
                    <h3>Utilisateurs</h3>
                </a>

                <a href="{{ route('admin.analyse') }}" class="{{ request()->routeIs('admin.analyse') ? 'active' : '' }}">
                    <span class="material-icons-sharp">bar_chart</span>
                    <h3>Analyse</h3>
                </a>

                <a href="{{ route('admin.parametres') }}" class="{{ request()->routeIs('admin.parametres') ? 'active' : '' }}">
                    <span class="material-icons-sharp">settings</span>
                    <h3>Paramètres</h3>
                </a>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Déconnexion</h3>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <main>
            {{-- BARRE SUPÉRIEURE --}}
            <div class="main-header">
                <div class="header-left">
                    @yield('page-title')
                </div>
                <div class="header-right">
                    <div class="theme-toggler">
                        <span class="material-icons-sharp active">light_mode</span>
                        <span class="material-icons-sharp">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p>Bonjour, <b>{{ Auth::user()->prenoms ?? 'Admin' }}</b></p>
                            <small class="text-muted">Administrateur</small>
                        </div>
                        <div class="profil-photo">
                            <img src="{{ asset('images/Admin_Profil.jpeg') }}" alt="Profil">
                        </div>
                    </div>
                    <button id="menu-btn">
                        <span class="material-icons-sharp">menu</span>
                    </button>
                </div>
            </div>

            {{-- Messages flash --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <span class="material-icons-sharp">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert" style="background: var(--color-danger); color: white;">
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                            <li><span class="material-icons-sharp" style="font-size: 1rem;">error</span> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content-wrapper">
                @yield('content')
            </div>
            
            {{-- Pour les pages qui ont encore besoin d'un panneau latéral (ex: Dashboard) --}}
            @hasSection('right-panel')
                <div class="dashboard-grid">
                    <div class="main-stats">
                        @yield('right-panel')
                    </div>
                </div>
            @endif
        </main>

    </div>

    {{-- ===== SCRIPTS ===== --}}
    <script>
        const sideMenu = document.querySelector("aside");
        const menuBtn = document.querySelector("#menu-btn");
        const closeBtn = document.querySelector("#close-btn");

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                sideMenu.style.display = 'block';
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                sideMenu.style.display = 'none';
            });
        }

        const themeToggler = document.querySelector('.theme-toggler');
        if (themeToggler) {
            themeToggler.addEventListener('click', () => {
                document.body.classList.toggle('dark_theme-variable');
                themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
                themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
