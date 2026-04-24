<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guichet extends Model
{
    protected $table = 'guichet';
    protected $fillable = ['code', 'statut'];

    /**
     * Le guichet a plusieurs sessions.
     */
    public function sessionGuichets()
    {
        return $this->hasMany(SessionGuichet::class, 'guichet_id');
    }

    /**
     * Session ouverte sur ce guichet, s'il en existe une.
     */
    public function sessionActive()
    {
        return $this->hasOne(SessionGuichet::class, 'guichet_id')
            ->where('statut', 'ouverte');
    }
}
