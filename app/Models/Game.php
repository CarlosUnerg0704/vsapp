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


}


    

