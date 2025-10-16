<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PlayerProfile;
use App\Services\RiotApi;

class PlayerProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->playerProfile;
        return view('rPlayer', compact('profile'));
    }

    public function store(Request $request, RiotApi $riot)
    {
        $validated = $request->validate([
            'riot_id' => ['required','string','regex:/^([^#]{3,16})#([A-Za-z0-9]{3,5})$/'],
            'platform' => 'required|in:la1,la2',
            'country' => 'required|string',
            'phone' => 'required|string|min:7|max:20',
        ], [
            'riot_id.regex' => 'Formato inválido. Usa GameName#TagLine (p. ej. Faker#KR1).',
        ]);

        $user = Auth::user();
        if ($user->playerProfile) {
            return back()->withErrors('Ya tienes un perfil registrado. Usa “Actualizar”.');
        }

        [$gameName, $tagLine] = explode('#', $validated['riot_id'], 2);
        $platform = $validated['platform'];
        $region = $riot->regionForPlatform($platform);

        // 1) Obtener PUUID
        $acc = $riot->getAccountByRiotId($region, $gameName, $tagLine);
        if (!$acc || empty($acc['puuid'])) {
            return back()->withErrors('No pudimos validar el Riot ID.')->withInput();
        }
        $puuid = $acc['puuid'];

        // 2) Obtener rank usando PUUID directamente
        $leagues = $riot->getLeaguesByPuuid($platform, $puuid);
        $solo = collect($leagues)->firstWhere('queueType', 'RANKED_SOLO_5x5');

        if (!$solo) {
            return back()->withErrors('No encontramos información de rango en SoloQ.')->withInput();
        }

        // 3) Crear perfil
        $user->playerProfile()->create([
            'country'         => $validated['country'],
            'phone'           => $validated['phone'],
            'riot_game_name'  => $gameName,
            'riot_tag_line'   => $tagLine,
            'puuid'           => $puuid,
            'summoner_name'   => $gameName . '#' . $tagLine,

            // Rank obligatorio
            'rank'            => $solo['tier'] . ' ' . $solo['rank'],
            'rank_queue'      => $solo['queueType'],
            'rank_tier'       => $solo['tier'],
            'rank_division'   => $solo['rank'],
            'rank_lp'         => $solo['leaguePoints'],

            'platform'        => $platform,
            'region'          => $region,
        ]);

        return redirect()->route('rPlayer')->with('success', 'Perfil creado con datos de Riot.');
    }

    public function update(Request $request, RiotApi $riot)
    {
        $validated = $request->validate([
            'riot_id' => ['required','string','regex:/^([^#]{3,16})#([A-Za-z0-9]{3,5})$/'],
            'platform' => 'required|in:la1,la2',
            'country' => 'required|string',
            'phone' => 'required|string|min:7|max:20',
        ]);

        $user = Auth::user();
        $profile = $user->playerProfile;
        if (!$profile) {
            return back()->withErrors('No tienes perfil aún. Regístralo primero.');
        }

        [$gameName, $tagLine] = explode('#', $validated['riot_id'], 2);
        $platform = $validated['platform'];
        $region = $riot->regionForPlatform($platform);

        $acc = $riot->getAccountByRiotId($region, $gameName, $tagLine);
        if (!$acc || empty($acc['puuid'])) {
            return back()->withErrors('No pudimos validar el Riot ID.')->withInput();
        }
        $puuid = $acc['puuid'];

        $leagues = $riot->getLeaguesByPuuid($platform, $puuid);
        $solo = collect($leagues)->firstWhere('queueType', 'RANKED_SOLO_5x5');

        if (!$solo) {
            return back()->withErrors('No encontramos información de rango en SoloQ.')->withInput();
        }

        $profile->update([
            'country'         => $validated['country'],
            'phone'           => $validated['phone'],
            'riot_game_name'  => $gameName,
            'riot_tag_line'   => $tagLine,
            'puuid'           => $puuid,
            'summoner_name'   => $gameName . '#' . $tagLine,

            'rank'            => $solo['tier'] . ' ' . $solo['rank'],
            'rank_queue'      => $solo['queueType'],
            'rank_tier'       => $solo['tier'],
            'rank_division'   => $solo['rank'],
            'rank_lp'         => $solo['leaguePoints'],

            'platform'        => $platform,
            'region'          => $region,
        ]);

        return redirect()->route('rPlayer')->with('success', 'Perfil actualizado con datos de Riot.');
    }
}
