<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\TournamentRegistration;
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
        $user = Auth::user();
        $tournament = Tournament::findOrFail($id);

        if (!$tournament->participants->contains($user->id)) {
            TournamentRegistration::create([
                'tournament_id' => $id,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back()->with('success', 'Registrado con éxito');
    }

    public function unregister($id)
    {
        $user = Auth::user();
        TournamentRegistration::where('tournament_id', $id)
            ->where('user_id', $user->id)
            ->delete();

        return redirect()->back()->with('success', 'Has abandonado el torneo');
    }

    public function create()
    {
        return view('tournaments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:1vs1,5vs5',
            'scheduled_at' => 'required|date',
        ]);

        Tournament::create($request->all());

        return redirect()->route('admin.panel')->with('success', 'Torneo creado con éxito');
    }
}
