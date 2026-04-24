@extends('layouts.admin')

@section('title', 'Analyse')

@section('page-title')
    <h1>Analyse des Transactions</h1>
@endsection

@section('content')
    <div class="insights">
        <div class="sale">
            <h3>Revenu total</h3>
            <h1>{{ number_format($totalRevenu, 0, ',', ' ') }} F</h1>
        </div>
        <div class="dysfunction">
            <h3>Nombre de passages</h3>
            <h1>{{ $totalPaiements }}</h1>
        </div>
    </div><br><br>

    <div class="passages-recents">
        <h2>Rapport des 7 derniers jours</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Nombre de passages</th>
                    <th>Revenu (F CFA)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paiements as $p)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($p->jour)->format('d/m/Y') }}</td>
                    <td>{{ $p->nombre }}</td>
                    <td class="success">{{ number_format($p->total, 0, ',', ' ') }} F</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
