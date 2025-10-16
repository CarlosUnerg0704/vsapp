<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;
use App\Models\GameParticipation;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name',
        'region',
        'capitan_name',
        'rank',
        'g_win',
        'g_lost',
    ];

    // Juegos donde este equipo es team1
    public function gamesAsTeam1()
    {
        return $this->hasMany(Game::class, 'team1_id');
    }

    // Juegos donde este equipo es team2
    public function gamesAsTeam2()
    {
        return $this->hasMany(Game::class, 'team2_id');
    }

    // Jugadores actuales del equipo
    public function players()
    {
        return $this->hasMany(User::class, 'current_team_id');
    }

    // Historial completo de juegos (team1 o team2)
    public function allGames()
    {
        return $this->gamesAsTeam1()
            ->with(['team1', 'team2', 'winner'])
            ->get()
            ->merge(
                $this->gamesAsTeam2()->with(['team1', 'team2', 'winner'])->get()
            )
            ->sortByDesc('played_at');
    }

    // Participaciones de los jugadores en juegos
    public function participations()
    {
        return $this->hasMany(GameParticipation::class);
    }
}
