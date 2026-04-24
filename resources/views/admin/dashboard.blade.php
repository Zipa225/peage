@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title')
    <h1>Dashboard</h1>
    <div class="date">
        <input type="date" value="{{ date('Y-m-d') }}">
    </div>
@endsection

@section('content')
    <div class="insights">
        <div class="sale">
            <span class="material-icons-sharp">analytics</span>
            <div class="middle" id="left">
                <div class="left">
                    <h3>Total paiements</h3>
                    <h1>{{ number_format($totalPaiements) }}</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='38' r='36'></circle>
                    </svg>
                    <div class="number">
                        <p>{{ $totalPaiements > 0 ? round($paiements24h / max($totalPaiements, 1) * 100) : 0 }}%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">{{ $paiements24h }} dernières 24h</small>
        </div>

        <div class="dysfunction">
            <span class="material-icons-sharp">account_balance_wallet</span>
            <div class="middle" id="middle">
                <div class="left">
                    <h3>Guichets actifs</h3>
                    <h1>{{ $guichetsActifs }} / {{ $totalGuichets }}</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='38' r='36'></circle>
                    </svg>
                    <div class="number">
                        <p>{{ $totalGuichets > 0 ? round($guichetsActifs / $totalGuichets * 100) : 0 }}%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">{{ $totalGuichets }} guichets au total</small>
        </div>

        <div class="income">
            <span class="material-icons-sharp">stacked_line_chart</span>
            <div class="middle" id="right">
                <div class="left">
                    <h3>Total revenu</h3>
                    <h1>{{ number_format($totalRevenu, 0, ',', ' ') }}F</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='38' r='36'></circle>
                    </svg>
                    <div class="number">
                        <p>{{ $totalRevenu > 0 ? round($revenu24h / max($totalRevenu, 1) * 100) : 0 }}%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">{{ number_format($revenu24h, 0, ',', ' ') }}F dernières 24h</small>
        </div>
    </div>
    <br><br>

    <div class="passages-recents">
        <h2>Passages récents</h2>
        <table>
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Montant</th>
                    <th>Matricule</th>
                    <th>Guichet</th>
                    <th>Paiement</th>
                </tr>
            </thead>
            <tbody>
                @forelse($passagesRecents as $paiement)
                <tr>
                    <td>{{ $paiement->categorieVehicule->libelle ?? '—' }}</td>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }}F CFA</td>
                    <td class="warning">{{ $paiement->immatriculation ?? '—' }}</td>
                    <td>{{ $paiement->guichet->code ?? '—' }}</td>
                    <td>{{ $paiement->typePaiement->libelle ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Aucun passage enregistré</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.paiements.index') }}">Tout afficher</a>
    </div>
@endsection

@section('right-panel')
    <div class="recent-updates">
        <h2>Statistiques rapides</h2>
        <div class="updates">
            <div class="update">
                <div class="profil-photo">
                    <img src="{{ asset('images/Admin_Profil.jpeg') }}" alt="">
                </div>
                <div class="message">
                    <p><b>{{ $totalUsers }}</b> utilisateurs enregistrés dans le système</p>
                    <small class="text-muted">Total</small>
                </div>
            </div>
            <div class="update">
                <div class="profil-photo">
                    <img src="{{ asset('images/Admin_Profil.jpeg') }}" alt="">
                </div>
                <div class="message">
                    <p><b>{{ $totalCategories }}</b> catégories de véhicules configurées</p>
                    <small class="text-muted">Référentiel</small>
                </div>
            </div>
        </div>
    </div>

    <div class="sales-analytics">
        <h2>Accès rapide</h2>
        <a href="{{ route('admin.paiements.create') }}" style="text-decoration:none;">
            <div class="item online">
                <div class="icon">
                    <span class="material-icons-sharp">add_card</span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>Nouveau paiement</h3>
                        <small class="text-muted">Enregistrer un passage</small>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.guichets.create') }}" style="text-decoration:none;">
            <div class="item add-product">
                <div>
                    <span class="material-icons-sharp">add</span>
                    <h3>Ajouter un guichet</h3>
                </div>
            </div>
        </a>
    </div>
@endsection
