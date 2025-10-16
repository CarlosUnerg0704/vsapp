<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        // compat heredado
        'summoner_name',
        'rank',

        'country',
        'phone',

        // Riot linkage
        'riot_game_name',
        'riot_tag_line',
        'puuid',
        'summoner_id',
        'profile_icon_id',
        'summoner_level',

        // Rank detallado
        'rank_queue',
        'rank_tier',
        'rank_division',
        'rank_lp',

        // routing
        'platform', // la1 / la2
        'region',   // americas
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
