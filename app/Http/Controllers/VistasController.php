<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PlayerProfile;


class VistasController extends Controller
{

    public function pList()
    {
        // Traemos todos los usuarios con su equipo (evita consultas N+1)
        $players = \App\Models\User::with('currentTeam')->get();

        return view('plist', compact('players'));
    }

    public function rPlayer(){
        return view('rPlayer');    
    }

}
