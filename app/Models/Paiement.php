<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiement';
    protected $fillable = [
        'date_paiement',
        'montant',
        'immatriculation',
        'categorie_vehicule_id',
        'type_paiement_id',
        'session_guichet_id',
        'statut'
    ];

    public function categorieVehicule()
    {
        return $this->belongsTo(CategorieVehicule::class, 'categorie_vehicule_id');
    }

    public function typePaiement()
    {
        return $this->belongsTo(TypePaiement::class, 'type_paiement_id');
    }

    /**
     * La session guichet à laquelle ce paiement est rattaché.
     */
    public function sessionGuichet()
    {
        return $this->belongsTo(SessionGuichet::class, 'session_guichet_id');
    }

    /**
     * Accès au guichet via la session (raccourci).
     */
    public function getGuichetAttribute()
    {
        return $this->sessionGuichet?->guichet;
    }

    /**
     * Accès à l'agent via la session (raccourci).
     */
    public function getUserAttribute()
    {
        return $this->sessionGuichet?->user;
    }
}
