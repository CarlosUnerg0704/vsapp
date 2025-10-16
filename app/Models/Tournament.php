<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'scheduled_at'];

    public function registrations()
    {
        return $this->hasMany(TournamentRegistration::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'tournament_registrations');
    }
}

