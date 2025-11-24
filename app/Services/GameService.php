<?php

namespace App\Services;

use App\Models\Tournament;
use App\Models\User;
use App\Models\Game;
use App\Models\GameParticipation;

class GameService
{
    /**
     * Generar la primera ronda de partidas (round 1)
     */
    public function generateInitialMatches(Tournament $tournament): void
    {
        $registrations = $tournament->registrations()->pluck('user_id')->shuffle()->values();

        for ($i = 0; $i < $registrations->count(); $i += 2) {
            if (!isset($registrations[$i + 1])) break;

            $this->createMatch(
                $tournament,
                $tournament->type,
                1,
                $registrations[$i],
                $registrations[$i + 1]
            );
        }
    }

    /**
     * Crear una partida entre dos usuarios o equipos
     */
    private function createMatch(Tournament $tournament, string $type, int $round, $id1, $id2): void
    {
        $player1 = User::find($id1);
        $player2 = User::find($id2);

        $team1Id = $player1->current_team_id ?? null;
        $team2Id = $player2->current_team_id ?? null;

        $game = Game::create([
            'tournament_id'     => $tournament->id,
            'round'             => $round,
            'team1_id'          => $type === '5vs5' ? $team1Id : null,
            'team2_id'          => $type === '5vs5' ? $team2Id : null,
            'player1_id'        => $type === '1vs1' ? $id1 : null,
            'player2_id'        => $type === '1vs1' ? $id2 : null,
            'score_team1'       => 0,
            'score_team2'       => 0,
        ]);

        GameParticipation::create([
            'user_id' => $id1,
            'game_id' => $game->id,
            'team_id' => $team1Id,
            'role'    => 'player',
        ]);

        GameParticipation::create([
            'user_id' => $id2,
            'game_id' => $game->id,
            'team_id' => $team2Id,
            'role'    => 'player',
        ]);
    }

    /**
     * Generar la siguiente ronda a partir de ganadores previos
     */
    public function generateNextRound(Tournament $tournament, int $currentRound): void
    {
        $winners = Game::where('tournament_id', $tournament->id)
            ->where('round', $currentRound)
            ->get()
            ->map(function ($game) use ($tournament) {
                return $tournament->type === '1vs1'
                    ? $game->winner_player_id
                    : $game->winner_id;
            })
            ->filter()
            ->shuffle()
            ->values();

        for ($i = 0; $i < $winners->count(); $i += 2) {
            if (!isset($winners[$i + 1])) break;

            $this->createMatch(
                $tournament,
                $tournament->type,
                $currentRound + 1,
                $winners[$i],
                $winners[$i + 1]
            );
        }
    }

    /**
     * Asignar ganador a una partida y generar siguiente ronda si corresponde
     */
    public function setWinner(Game $game, int $winnerId): void
    {
        $tournament = $game->tournament;

        if ($tournament->type === '1vs1') {
            $game->winner_player_id = $winnerId;
        } else {
            $game->winner_id = $winnerId;
        }

        $game->save();

        // Verificar si todos los juegos de esta ronda tienen ganador
        $games = Game::where('tournament_id', $tournament->id)
            ->where('round', $game->round)
            ->get();

        $allCompleted = $games->every(function ($g) use ($tournament) {
            return $tournament->type === '1vs1'
                ? $g->winner_player_id !== null
                : $g->winner_id !== null;
        });

        if ($allCompleted) {
            $this->generateNextRound($tournament, $game->round);
        }
    }
}
