@extends('layouts.admin')

@section('title', 'Nouveau Paiement')

@section('page-title')
    <h1>Enregistrer un passage</h1>
@endsection

@section('content')
    <div class="passages-recents form-centered" style="margin-top: 1rem;">
        <div style="background: var(--color-white); padding: var(--card-padding); border-radius: var(--card-border-radius); box-shadow: var(--box-shadow);">
            <form action="{{ route('admin.paiements.store') }}" method="POST" id="paiement-form">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Immatriculation du véhicule</label>
                        <input type="text" name="immatriculation" placeholder="Ex: AA-123-BB" style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Catégorie de véhicule</label>
                        <select name="categorie_vehicule_id" id="categorie_vehicule_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Montant encaissé (F CFA) - <small>Automatique</small></label>
                        <input type="number" name="montant" id="montant" readonly style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: #f0f0f0; color: var(--color-dark); cursor: not-allowed;">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Type de paiement</label>
                        <select name="type_paiement_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Guichet</label>
                        <select name="guichet_id" required style="width: 100%; padding: 0.8rem; border-radius: var(--border-radius-1); border: 2px solid var(--color-info-light); background: var(--color-primary); color: var(--color-dark);">
                            @foreach($guichets as $g)
                                <option value="{{ $g->id }}">{{ $g->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="date_paiement" value="{{ now() }}">
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                    <button type="submit" style="background: var(--color-light); color: white; padding: 1rem 2.5rem; border-radius: var(--border-radius-1); cursor: pointer; border: none; font-weight: 600; width: 100%;">Valider le paiement</button>
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

        const catSelect = document.getElementById('categorie_vehicule_id');
        const montantInput = document.getElementById('montant');

        catSelect.addEventListener('change', function() {
            const catId = this.value;
            if (tarifs[catId]) {
                montantInput.value = tarifs[catId];
            } else {
                montantInput.value = "";
            }
        });

        // Debug au cas où
        document.getElementById('paiement-form').onsubmit = function() {
            if (!montantInput.value) {
                alert("Veuillez sélectionner une catégorie pour obtenir le prix.");
                return false;
            }
            return true;
        };
    </script>
@endsection
