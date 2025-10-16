<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\User;
use App\Models\Team;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $recentGames = Game::with(['team1','team2','winner'])
            ->orderByDesc('played_at')
            ->limit(5)
            ->get();

        $topPlayers = User::with('participations')->get()
            ->map(function ($player) {
                $total = $player->participations->count();
                $wins  = $player->participations->where('result', 'win')->count();
                $player->winrate = $total > 0 ? round(($wins / $total) * 100, 1) : 0;
                $player->games_played = $total;
                return $player;
            })
            ->sortByDesc('winrate')
            ->take(3);

        $topTeams = Team::all()
            ->map(function ($team) {
                $total = $team->g_win + $team->g_lost;
                $team->winrate = $total > 0 ? round(($team->g_win / $total) * 100, 1) : 0;
                return $team;
            })
            ->sortByDesc('winrate')
            ->take(3);

        $user = Auth::user();
        $wallet = $user->wallet;

        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => $user->id,
                'balance' => 0
            ]);
        }

        $domicoinsAvailable = $wallet->balance;

        $domicoinsToday = $wallet->transactions()
            ->where('type', 'reward')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        $domicoinsThisWeek = $wallet->transactions()
            ->where('type', 'reward')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('amount');

        $domicoinsPending = 0;

        return view('dashboard', compact(
            'recentGames',
            'topPlayers',
            'topTeams',
            'domicoinsToday',
            'domicoinsThisWeek',
            'domicoinsPending',
            'domicoinsAvailable'
        ));
    }
}