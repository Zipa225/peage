@extends('layouts.admin')

@section('title', 'Modifier Paiement')

@section('page-title')
    <h1>Modifier le passage</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">

            {{-- Info session liée --}}
            @if($paiement->sessionGuichet)
                <div style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.25); border-radius: 8px; padding: 0.7rem 1rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: var(--color-dark-variant);">
                    <span class="material-icons-sharp" style="font-size: 1rem; vertical-align: middle; color: #10b981;">info</span>
                    Paiement rattaché à la session du guichet <strong>{{ $paiement->sessionGuichet->guichet?->code ?? '—' }}</strong>
                </div>
            @endif

            <form action="{{ route('admin.paiements.update', $paiement->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Immatriculation du véhicule</label>
                        <input type="text" name="immatriculation" value="{{ old('immatriculation', $paiement->immatriculation) }}" placeholder="Ex: AA-123-BB" style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Catégorie de véhicule</label>
                        <select name="categorie_vehicule_id" id="categorie_vehicule_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $paiement->categorie_vehicule_id == $cat->id ? 'selected' : '' }}>{{ $cat->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Montant encaissé (F CFA) - <small>Auto</small></label>
                        <input type="number" name="montant" id="montant" value="{{ $paiement->montant }}" required readonly style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: #f0f0f0; color: var(--color-dark); cursor: not-allowed;">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Type de paiement</label>
                        <select name="type_paiement_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $paiement->type_paiement_id == $type->id ? 'selected' : '' }}>{{ $type->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <button type="submit" style="background: var(--color-light); color: white; padding: 1rem 2.5rem; border-radius: var(--border-radius-1); cursor: pointer; border: none; font-weight: 600; width: 100%;">Enregistrer les modifications</button>
                    <a href="{{ route('admin.paiements.index') }}" style="padding: 1rem 2rem; border-radius: var(--border-radius-1); text-decoration: none; color: var(--color-dark); border: 2px solid var(--color-info-light); display: inline-flex; align-items: center; justify-content: center; width: 100%;">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const tarifs = {
            @foreach($tarifs as $tarif)
                "{{ $tarif->categorie_vehicule_id }}": {{ $tarif->montant }},
            @endforeach
        };

        document.getElementById('categorie_vehicule_id').addEventListener('change', function() {
            const catId = this.value;
            const montantInput = document.getElementById('montant');
            
            if (tarifs[catId]) {
                montantInput.value = tarifs[catId];
            } else {
                montantInput.value = "";
            }
        });
    </script>
@endsection
