@extends('layouts.admin')

@section('title', 'Types de Paiement')

@section('page-title')
    <h1>Modes de Paiement</h1>
@endsection

@section('content')
    <div class="date">
        <a href="{{ route('admin.types-paiements.create') }}" style="background: var(--color-light); color: white; padding: 0.5rem 1.6rem; border-radius: var(--border-radius-1); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <span class="material-icons-sharp" style="font-size: 1.2rem;">add</span>
            Nouveau mode
        </a>
    </div>

    <div class="passages-recents">
        <h2>Modes acceptés (Espèces, Wave, OM...)</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td><b>{{ $type->libelle }}</b></td>
                    <td>
                        <a href="{{ route('admin.types-paiements.edit', $type->id) }}"><span class="material-icons-sharp" style="color: var(--color-waring);">edit</span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
