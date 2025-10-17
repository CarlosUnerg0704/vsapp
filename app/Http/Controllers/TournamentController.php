<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\TournamentRegistration;
use App\Models\Game;
use App\Models\GameParticipation;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::with('registrations')->get();
        $user = Auth::user();

        return view('tournaments.index', compact('tournaments', 'user'));
    }

    public function register($id)
    {
        $userId = auth()->id();

        $already = TournamentRegistration::where('tournament_id', $id)
            ->where('user_id', $userId)
            ->exists();

        if (!$already) {
            TournamentRegistration::create([
                'tournament_id' => $id,
                'user_id' => $userId,
            ]);
        }

        return redirect()->back()->with('success', 'Registrado al torneo.');
    }

    public function unregister($id)
    {
        $userId = auth()->id();

        TournamentRegistration::where('tournament_id', $id)
            ->where('user_id', $userId)
            ->delete();

        return redirect()->back()->with('success', 'Has abandonado el torneo.');
    }

    public function create()
    {
        return view('tournaments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|in:1vs1,5vs5',
        ]);

        Tournament::create($validated);

        return redirect()->back()->with('success', 'Torneo creado exitosamente.');
    }

    public function show($id)
    {
        $tournament = Tournament::findOrFail($id);
        $registeredUsers = $tournament->registrations()->with('user.profile')->get();
        $userRegistered = $tournament->registrations()->where('user_id', auth()->id())->exists();

        $now = now();
        $scheduledTime = $tournament->scheduled_at;
        $minutesToStart = $now->diffInMinutes($scheduledTime, false);

        $registrationOpen = true;

        if (
            ($tournament->type === '1vs1' && $minutesToStart <= 10) ||
            ($tournament->type === '5vs5' && $minutesToStart <= 30)
        ) {
            $registrationOpen = false;

            if ($tournament->games()->count() === 0 && $registeredUsers->count() >= 2) {
                $this->generateMatches($tournament);
            }
        }

        $games = $tournament->games()->with(['player1.profile', 'player2.profile'])->get();

        return view('tournaments.show', compact('tournament', 'registeredUsers', 'userRegistered', 'registrationOpen', 'games'));
    }

    private function generateMatches(Tournament $tournament)
    {
        $registrations = $tournament->registrations()->pluck('user_id')->shuffle()->values();

        for ($i = 0; $i < $registrations->count(); $i += 2) {
            if (!isset($registrations[$i + 1])) break;

            $player1 = $registrations[$i];
            $player2 = $registrations[$i + 1];

            $team1Id = Auth::user()->find($player1)->current_team_id;
            $team2Id = Auth::user()->find($player2)->current_team_id;

            $game = Game::create([
                'team1_id' => $team1Id,
                'team2_id' => $team2Id,
                'winner_id' => null,
                'score_team1' => 0,
                'score_team2' => 0,
                'played_at' => null,
                'tournament_id' => $tournament->id,
                'player1_id' => $player1,
                'player2_id' => $player2,
                'winner_player_id' => null
            ]);

            GameParticipation::create([
                'user_id' => $player1,
                'game_id' => $game->id,
                'team_id' => $team1Id,
                'role' => 'player',
            ]);

            GameParticipation::create([
                'user_id' => $player2,
                'game_id' => $game->id,
                'team_id' => $team2Id,
                'role' => 'player',
            ]);
        }
    }
}