<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RiotApi
{
    private string $token;

    public function __construct()
    {
        $this->token = (string) config('services.riot.key', env('RIOT_API_KEY', ''));
    }

    protected function client()
    {
        return Http::withHeaders(['X-Riot-Token' => $this->token])
            ->timeout(10)
            ->retry(2, 500);
    }

    /** Riot ID -> Account (PUUID) */
    public function getAccountByRiotId(string $region, string $gameName, string $tagLine): ?array
    {
        $url = "https://{$region}.api.riotgames.com/riot/account/v1/accounts/by-riot-id/"
             . rawurlencode($gameName) . "/" . rawurlencode($tagLine);

        $res = $this->client()->get($url);
        return $res->successful() ? $res->json() : null;
    }

    /** League-V4: Rank usando directamente PUUID */
    public function getLeaguesByPuuid(string $platform, string $puuid): array
    {
        $url = "https://{$platform}.api.riotgames.com/lol/league/v4/entries/by-puuid/{$puuid}";
        $res = $this->client()->get($url);
        return $res->successful() ? $res->json() : [];
    }

    /** Platform -> Region */
    public function regionForPlatform(string $platform): string
    {
        return match ($platform) {
            'la1','la2','na1','br1' => 'americas',
            'euw1','eun1','tr1','ru' => 'europe',
            'kr','jp1'               => 'asia',
            'oc1','ph2','sg2','th2','tw2','vn2' => 'sea',
            default => 'americas',
        };
    }
}
