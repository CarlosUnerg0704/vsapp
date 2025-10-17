<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;


class Tournament extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'time', 'type'];


    public function registrations()
    {
        return $this->hasMany(TournamentRegistration::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'tournament_registrations');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

}

