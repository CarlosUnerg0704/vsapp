<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\WalletTransaction;
use App\Models\TournamentRegistration;
use App\Models\Game;
use App\Models\GameParticipation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\GameService;
use Illuminate\Support\Facades\DB;


class TournamentController extends Controller
{
    /** ============================
     *  LISTAR TORNEOS
     *  ============================ */
    
    public function index(GameService $gameService)
{
    $user = Auth::user();

    // Cargamos torneos con sus registros y juegos
    $tournaments = Tournament::with(['registrations', 'games'])->get();

    foreach ($tournaments as $tournament) {
        // IMPORTANTE:
        // Usa aquí EXACTAMENTE el valor de status que representa "en proceso"
        // Por ejemplo: 'en_proceso' o 'en proceso'
        if ($tournament->status === 'en_proceso' && !$tournament->games()->exists()) {
            // Genera las llaves (partidas iniciales) automáticamente
            $gameService->generateInitialMatches($tournament);
        }
    }

    // Volvemos a cargar la relación 'games' por si se acaban de crear
    $tournaments->load('games');

    return view('tournaments.index', compact('tournaments', 'user'));
}


    /** ============================
     *  REGISTRARSE EN UN TORNEO
     *  ============================ */
    public function register($id)
    {
        $tournament = Tournament::findOrFail($id);
        $user = auth()->user();

        // Evitar duplicados
        if (TournamentRegistration::where('tournament_id', $tournament->id)
            ->where('user_id', $user->id)
            ->exists()) {
            return redirect()->route('tournaments.show', $tournament->id)
                ->with('error', 'Ya estás registrado en este torneo.');
        }

        // Verificar créditos (domicoins)
        $wallet = $user->wallet;

        if (!$wallet || $wallet->balance < $tournament->entry_fee) {
            return redirect()->route('tournaments.show', $tournament->id)
                ->with('error', 'No tienes suficientes Domicoins para registrarte.');
        }

        // Comparar hora actual (UTC) con hora programada (UTC)
        $nowUTC = Carbon::now('UTC');
        $scheduledUTC = $tournament->scheduled_at->copy()->setTimezone('UTC');
        $minutesToStart = $nowUTC->diffInMinutes($scheduledUTC, false);

        // Cerrar registro 10 minutos antes del inicio
        if ($minutesToStart <= 10) {
            return redirect()->route('tournaments.show', $tournament->id)
                ->with('error', 'El registro ya está cerrado.');
        }

        //try/cath
        DB::beginTransaction();

        try {

            // Asegurar que el usuario tiene wallet
            if (!$wallet) {
                throw new \Exception("El usuario no tiene wallet asignada.");
            }

            // Registrar al jugador
            TournamentRegistration::create([
                'tournament_id' => $tournament->id,
                'user_id'       => $user->id,
            ]);

            // Descontar domicoins
            $wallet->balance -= $tournament->entry_fee;
            $wallet->save();

            // Registrar transacción
            WalletTransaction::create([
                'wallet_id'   => $wallet->id,
                'type'        => 'debit',
                'amount'      => $tournament->entry_fee,
                'description' => 'Registro en torneo: ' . $tournament->name,
            ]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            if (config('app.debug')) {
                // MOSTRAR ERROR REAL EN LOCAL
                return back()->with('error', $e->getMessage());
            }

            // MENSAJE SEGURO PARA PRODUCCIÓN
            return back()->with('error', 'Ocurrió un error al registrarte.');
        }


        return redirect()->route('tournaments.show', $tournament->id)
            ->with('success', 'Te has registrado exitosamente en el torneo.');
    }

    /** ============================
     *  ABANDONAR TORNEO
     *  ============================ */
    public function unregister($id)
    {
        $tournament = Tournament::findOrFail($id);
        $user = auth()->user();

        $registration = TournamentRegistration::where('tournament_id', $tournament->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$registration) {
            return redirect()->route('tournaments.show', $tournament->id)
                ->with('error', 'No estás registrado en este torneo.');
        }

        $registration->delete();

        return redirect()->route('tournaments.show', $tournament->id)
            ->with('success', 'Has abandonado el torneo.');
    }

    /** ============================
     *  CREAR TORNEO (ADMIN)
     *  ============================ */
    public function create()
    {
        return view('tournaments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'entry_fee'  => 'required|numeric|min:0',
            'type' => 'required|in:1vs1,5vs5',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        /**
         * ⚙️ Guardamos la hora exactamente como la seleccionas (hora local),
         * sin convertir manualmente a UTC (Laravel/MySQL ya lo manejan internamente).
         */
        $scheduledAtLocal = Carbon::parse($request->date . ' ' . $request->time, config('app.timezone'));

        $tournament = Tournament::create([
            'name'         => $request->name,
            'entry_fee'    => $request->entry_fee,
            'type'         => $request->type,
            'scheduled_at' => $scheduledAtLocal,
        ]);

        return redirect()->route('tournaments.show', $tournament->id)
            ->with('success', 'Torneo creado correctamente.');
    }

    /** ============================
     *  MOSTRAR TORNEO
     *  ============================ */
    public function show($id)
    {
        $tournament = Tournament::findOrFail($id);

        // Jugadores registrados
        $registeredUsers = $tournament->registrations()
            ->with('user.profile', 'user.team')
            ->get();

        $userRegistered = $tournament->registrations()
            ->where('user_id', auth()->id())
            ->exists();

        // 🕓 Comparar en UTC para los botones
        $nowUTC = Carbon::now('UTC');
        $scheduledUTC = $tournament->scheduled_at
            ? $tournament->scheduled_at->copy()->setTimezone('UTC')
            : null;

        $minutesToStart = $scheduledUTC
            ? $nowUTC->diffInMinutes($scheduledUTC, false)
            : null;

        $tournamentStarted = $scheduledUTC
            ? $nowUTC->gte($scheduledUTC)
            : false;

        // Mostrar hora local al usuario
        $scheduledDisplay = $tournament->scheduled_at
            ? $tournament->scheduled_at->copy()->timezone(config('app.timezone'))
            : null;

        /**
         * 🔘 Lógica de botones:
         * - "Registrarse": visible si faltan >10 min y el usuario no está registrado.
         * - "Abandonar": visible si el usuario está registrado y el torneo no ha comenzado.
         */
        $showRegisterBtn = false;
        $showUnregisterBtn = false;

        $role = strtolower(auth()->user()->role ?? '');
        if (in_array($role, ['player', 'captain', 'jugador'])) {
            if (!$userRegistered && $minutesToStart !== null && $minutesToStart > 10) {
                $showRegisterBtn = true;
            }
            if ($userRegistered && !$tournamentStarted) {
                $showUnregisterBtn = true;
            }
        }

        /**
         * 🧩 Autogenerar llaves usando EL MISMO status del modelo
         */
        $status = $tournament->status; // usa el accessor getStatusAttribute()
        $hasGames = $tournament->games()->exists();

        if ($status === 'en_proceso' && !$hasGames) {
            // Generamos las partidas iniciales (round 1) SOLO una vez
            $this->generateMatches($tournament);

            // Recargar la relación de juegos
            $tournament->load('games');
        }

        // Cargar juegos con relaciones para mostrar los brackets
        $games = $tournament->games()
            ->with(['player1.profile', 'player2.profile', 'team1', 'team2', 'winnerPlayer', 'winningTeam'])
            ->get();

        return view('tournaments.show', compact(
            'tournament',
            'registeredUsers',
            'userRegistered',
            'games',
            'showRegisterBtn',
            'showUnregisterBtn',
            'scheduledDisplay'
        ));
    }


    /** ============================
     *  GENERAR PARTIDAS (ROUND 1)
     *  ============================ */
    private function generateMatches(Tournament $tournament)
    {
        
        // Tomamos todos los usuarios registrados al torneo y los mezclamos aleatoriamente
        $registrations = $tournament->registrations()->pluck('user_id')->shuffle()->values();

        // Emparejamos de 2 en 2
        for ($i = 0; $i < $registrations->count(); $i += 2) {
            // Si no hay par, el último se queda sin partida en esta ronda
            if (!isset($registrations[$i + 1])) {
                break;
            }

            $player1Id = $registrations[$i];
            $player2Id = $registrations[$i + 1];

            $player1 = User::find($player1Id);
            $player2 = User::find($player2Id);

            $team1Id = $player1->current_team_id ?? null;
            $team2Id = $player2->current_team_id ?? null;

            // Creamos el juego
            $game = Game::create([
                'tournament_id'     => $tournament->id,
                'round'             => 1,
                'team1_id'          => $tournament->type === '5vs5' ? $team1Id : null,
                'team2_id'          => $tournament->type === '5vs5' ? $team2Id : null,
                'winner_id'         => null,
                'score_team1'       => 0,
                'score_team2'       => 0,
                'played_at'         => null,
                'player1_id'        => $tournament->type === '1vs1' ? $player1Id : null,
                'player2_id'        => $tournament->type === '1vs1' ? $player2Id : null,
                'winner_player_id'  => null,
            ]);

            // Registramos participación jugador 1
            GameParticipation::create([
                'user_id' => $player1Id,
                'game_id' => $game->id,
                'team_id' => $team1Id,
                'role'    => 'player',
            ]);

            // Registramos participación jugador 2
            GameParticipation::create([
                'user_id' => $player2Id,
                'game_id' => $game->id,
                'team_id' => $team2Id,
                'role'    => 'player',
            ]);
        }
    }



    /** ============================
     *  DEFINIR GANADOR
     *  ============================ */
    public function setWinner(Request $request, Game $game)
    {
        $tournament = $game->tournament;

        if ($tournament->type === '1vs1') {
            $winnerId = $request->input('winner_player_id');
            $game->winner_player_id = $winnerId;
        } else {
            $winnerId = $request->input('winner_id');
            $game->winner_id = $winnerId;
        }

        $game->save();

        // Verificar si todos los juegos de la ronda tienen ganador
        $allGamesInRound = Game::where('tournament_id', $tournament->id)
            ->where('round', $game->round)
            ->get();

        $allCompleted = $allGamesInRound->every(function ($g) use ($tournament) {
            return $tournament->type === '1vs1'
                ? !is_null($g->winner_player_id)
                : !is_null($g->winner_id);
        });

        if ($allCompleted) {
            $this->generateNextRound($tournament, $game->round + 1);
        }

        return redirect()->back()->with('success', 'Ganador guardado y próxima ronda generada si corresponde.');
    }

    /** ============================
     *  GENERAR SIGUIENTE RONDA
     *  ============================ */
    private function generateNextRound(Tournament $tournament, int $round)
    {
        $previousWinners = Game::where('tournament_id', $tournament->id)
            ->where('round', $round - 1)
            ->get()
            ->map(function ($game) use ($tournament) {
                return $tournament->type === '1vs1'
                    ? $game->winner_player_id
                    : $game->winner_id;
            })
            ->filter()
            ->shuffle()
            ->values();

        for ($i = 0; $i < $previousWinners->count(); $i += 2) {
            if (!isset($previousWinners[$i + 1])) break;

            $team1Id   = $tournament->type === '5vs5' ? $previousWinners[$i]     : null;
            $team2Id   = $tournament->type === '5vs5' ? $previousWinners[$i + 1] : null;
            $player1Id = $tournament->type === '1vs1' ? $previousWinners[$i]     : null;
            $player2Id = $tournament->type === '1vs1' ? $previousWinners[$i + 1] : null;

            $game = Game::create([
                'tournament_id'    => $tournament->id,
                'round'            => $round,
                'team1_id'         => $team1Id,
                'team2_id'         => $team2Id,
                'player1_id'       => $player1Id,
                'player2_id'       => $player2Id,
                'winner_id'        => null,
                'winner_player_id' => null,
            ]);

            if ($tournament->type === '1vs1') {
                GameParticipation::insert([
                    ['game_id' => $game->id, 'user_id' => $player1Id, 'role' => 'player'],
                    ['game_id' => $game->id, 'user_id' => $player2Id, 'role' => 'player'],
                ]);
            }
        }
    }
}
