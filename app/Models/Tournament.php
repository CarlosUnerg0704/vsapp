<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = ['name', 'date', 'time'];

    public function registrations()
    {
        return $this->hasMany(TournamentRegistration::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tournament_registrations');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
