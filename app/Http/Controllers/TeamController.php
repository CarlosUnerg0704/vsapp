<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Game;
use App\Models\User;
use App\Models\Auth;

class TeamController extends Controller
{
    public function tList()
    {
        $teams = Team::all();

        return view('tList', ['teams' => $teams]);
    }

    public function show($id)
    {
        $team = Team::with(['players', 'gamesAsTeam1', 'gamesAsTeam2'])->findOrFail($id);

        return view('teams.show', compact('team'));
    }
//DESPEDIR JUGADOR
    public function kickPlayer(Team $team, User $player)
    {
        $auth = auth()->user();
        
        if ($auth->role !== 'captain' || $auth->current_team_id !== $team->id) {
            abort(403, 'No autorizado.');
        }

        if ($player->current_team_id === $team->id) {
            $player->current_team_id = null;
            $player->save();
        }

        return redirect()->back()->with('status', 'Jugador despedido.');
    }
//ACTUALIZAR ROL DEL JUGADOR
    public function updateRole(Request $request, Team $team, User $player)
    {
        $authUser = auth()->user();

        // Seguridad: solo el capitán del equipo puede cambiar roles
        if ($authUser->role !== 'captain' || $authUser->current_team_id !== $team->id) {
            abort(403, 'Not authorized.');
        }

        // Validar entrada
        $validated = $request->validate([
            'role' => 'required|string|in:*,Top Lane,Jungle,Mid Lane,Bot Lane,Support',
        ]);

        // Guardar el nuevo rol en el perfil del jugador
        $profile = $player->profile;
        $profile->role = $validated['role'] === '*' ? null : $validated['role'];
        $profile->save();

        return redirect()->back()->with('status', 'Role updated successfully.');
    }

}



