<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';

    // La table 'user' n'a pas de colonne 'updated_at'
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'user_id');
    }

    /**
     * Retourne le nom complet de l'utilisateur.
     */
    public function getNomCompletAttribute(): string
    {
        return $this->prenoms . ' ' . $this->nom;
    }
}
