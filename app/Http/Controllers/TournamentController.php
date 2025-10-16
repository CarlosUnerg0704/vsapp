<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::all();
        return view('tournaments.index', compact('tournaments'));
    }

    public function show($id)
    {
        $tournament = Tournament::with('registrations.user')->findOrFail($id);
        $user = Auth::user();
        $isRegistered = $tournament->registrations()->where('user_id', $user->id)->exists();
        return view('tournaments.show', compact('tournament', 'isRegistered'));
    }

    public function register($id)
    {
        $tournament = Tournament::findOrFail($id);
        $user = Auth::user();
        $tournament->registrations()->firstOrCreate(['user_id' => $user->id]);
        return redirect()->route('tournaments.show', $id);
    }

    public function unregister($id)
    {
        $tournament = Tournament::findOrFail($id);
        $user = Auth::user();
        $tournament->registrations()->where('user_id', $user->id)->delete();
        return redirect()->route('tournaments.show', $id);
    }
}
