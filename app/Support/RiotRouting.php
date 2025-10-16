<?php

namespace App\Services;

class RiotRouting
{
    public static function regionForPlatform(string $platform): string
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
