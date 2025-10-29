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
        'round',
    ];

    protected $casts = [
        'played_at' => 'datetime',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function winningTeam()
    {
        return $this->belongsTo(Team::class, 'winner_id');
    }

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

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function winner()
    {
        if ($this->winner_player_id) {
            return $this->winnerPlayer();
        }

        if ($this->winner_id) {
            return $this->winningTeam();
        }

        return null;
    }
}

