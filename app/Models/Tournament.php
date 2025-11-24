<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use Carbon\Carbon;


class Tournament extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['name', 'type','entry_fee', 'scheduled_at'];
=======
    protected $fillable = ['name', 'type', 'scheduled_at'];
>>>>>>> 4302d7e3ddabe5ba475e2ada0bb399f36d8c99b4

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];


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

public function getStatusAttribute(): string
{
    $now = Carbon::now('UTC');
    $start = $this->scheduled_at->copy()->setTimezone('UTC');

    $hasGames = $this->games()->exists();
    $lastRound = $this->games()->max('round');
    $lastGames = $this->games()->where('round', $lastRound)->get();

    $hasWinner = $lastGames->count() > 0 && $lastGames->every(function ($game) {
        return $this->type === '1vs1'
            ? $game->winner_player_id !== null
            : $game->winner_id !== null;
    });

    if ($hasWinner) return 'finalizado';

    $minutesToStart = $now->diffInMinutes($start, false);

    if ($minutesToStart > 10) {
        return 'registro';
    } elseif ($minutesToStart <= 10 && $minutesToStart > 0) {
        return 'preinicio';
    } elseif ($now->gte($start)) {
        return 'en_proceso';
    }

    return 'desconocido';
}


}

