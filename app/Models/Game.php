<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'team1_id',
        'team2_id',
        'winner_id',
        'player1_id',
        'player2_id',
        'winner_player_id',
        'tournament_id',
        'score_team1',
        'score_team2',
        'played_at',
    ];

    protected $casts = [
        'played_at' => 'datetime',
    ];

    // 🔹 Relaciones con equipos
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function winner()
    {
        return $this->belongsTo(Team::class, 'winner_id');
    }

    // 🔹 Relaciones con jugadores (para 1vs1)
    public function player1()
    {
        return $this->belongsTo(User::class, 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo(User::class, 'player2_id');
    }

    public function winnerPlayer()
    {
        return $this->belongsTo(User::class, 'winner_player_id');
    }

    // 🔹 Relación con torneo
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
