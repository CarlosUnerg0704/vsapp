<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'id',
        'rank_solo',
        'teams',
        'i_names',
        'g_win',
        'g_lost',
    ];

}
