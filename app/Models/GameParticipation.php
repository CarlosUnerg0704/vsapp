<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameParticipation extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id', 'team_id', 'user_id', 'role', 'result'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function player()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


