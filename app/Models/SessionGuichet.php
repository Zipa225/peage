<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionGuichet extends Model
{
    protected $table = 'session_guichet';

    protected $fillable = [
        'user_id',
        'guichet_id',
        'date_ouverture',
        'date_fermeture',
        'statut',
    ];

    protected $casts = [
        'date_ouverture' => 'datetime',
        'date_fermeture' => 'datetime',
    ];

    /**
     * La session appartient à un utilisateur (agent).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * La session appartient à un guichet.
     */
    public function guichet()
    {
        return $this->belongsTo(Guichet::class, 'guichet_id');
    }

    /**
     * La session a plusieurs paiements.
     */
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'session_guichet_id');
    }

    /**
     * Retourne le total des paiements de cette session.
     */
    public function totalMontant(): float
    {
        return (float) $this->paiements()->sum('montant');
    }

    /**
     * Retourne le nombre de transactions de cette session.
     */
    public function nombreTransactions(): int
    {
        return $this->paiements()->count();
    }
}
