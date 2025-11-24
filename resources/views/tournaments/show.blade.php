<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Torneo: {{ $tournament->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        {{-- Mensajes --}}
        @if(session('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow sm:rounded-lg p-6 space-y-8">
            {{-- Detalles del torneo --}}
            <div class="border-b pb-4">
<<<<<<< HEAD
                <p><strong>Nombre del Torneo: </strong>{{$tournament->name}}</p>
=======
>>>>>>> 4302d7e3ddabe5ba475e2ada0bb399f36d8c99b4
                <p><strong>Formato:</strong> {{ strtoupper($tournament->type) }}</p>
                <p><strong>Programado para:</strong>
                    {{ optional($tournament->scheduled_at)->timezone(config('app.timezone'))->format('Y-m-d H:i') }}
                </p>
            </div>

            {{-- Inscritos y botones --}}
            <div class="space-y-3 mt-3">
                <h3 class="text-lg font-semibold">Inscritos</h3>

                @if($registeredUsers->isEmpty())
                    <p class="text-gray-600">Aún no hay jugadores inscritos.</p>
                @else
                    <ul class="list-disc list-inside">
                        @foreach($registeredUsers as $reg)
                            <li>{{ $reg->user->profile->summoner_name ?? $reg->user->name }}</li>
                        @endforeach
                    </ul>
                @endif

                @php
                    $status = $tournament->status;
                    $role = auth()->user()->role ?? null;
                    $roleIsPlayer = in_array($role, ['player', 'captain', 'jugador']);
                @endphp

                {{-- Botón de registro --}}
                @if($status === 'registro' && !$userRegistered && $roleIsPlayer)
                    <form action="{{ route('tournaments.register', $tournament->id) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Registrarse en el Torneo
                        </button>
                    </form>
                @endif

                {{-- Botón de abandono --}}
                @if($status === 'registro' && $userRegistered && $roleIsPlayer)
                    <form action="{{ route('tournaments.unregister', $tournament->id) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                            Abandonar Torneo
                        </button>
                    </form>
                @endif

                {{-- Mensaje: torneo está por comenzar --}}
                @if($status === 'preinicio')
                    <div class="text-yellow-700 bg-yellow-100 p-3 rounded shadow-sm">
                        ⏳ El torneo está por comenzar. Las partidas están siendo generadas.
                    </div>
                @endif
            </div>

<<<<<<< HEAD
            {{-- ========================= --}}
            {{--   LLAVES / BRACKETS       --}}
            {{-- ========================= --}}
            <div class="mt-10">
                <h3 class="text-lg font-bold mb-4">Llaves del Torneo</h3>

                @php
                    $gamesByRound = $games->sortBy('id')->groupBy('round');
                    $is1v1 = $tournament->type === '1vs1';

                    $playersCount = max(0, $registeredUsers->count());

                    $nextPow2 = 1;
                    while ($nextPow2 < max(2, $playersCount)) { $nextPow2 *= 2; }

                    $totalRounds = 0; $tmp = $nextPow2;
                    while ($tmp > 1) { $tmp = $tmp / 2; $totalRounds++; }

                    $label = function($userOrTeam) use ($is1v1) {
                        if (!$userOrTeam) return 'TBD';
                        if ($is1v1) {
                            return $userOrTeam->profile->summoner_name ?? $userOrTeam->name ?? 'TBD';
                        } else {
                            return $userOrTeam->name ?? 'TBD';
                        }
                    };
                @endphp

                @if($playersCount < 2)
                    <p class="text-gray-600">Aún no hay suficientes inscritos para generar llaves.</p>
                @else
                    <div class="bracket-wrap">
                        @for($round = 1; $round <= $totalRounds; $round++)
                            @php
                                $matchesInRound = (int) ($nextPow2 / pow(2, $round));
                                $roundGames = ($gamesByRound[$round] ?? collect())->values();
                            @endphp

                            <div class="round-col">
                                <div class="round-title">
                                    {{ $round === $totalRounds ? '🏆 Final' : 'Ronda ' . $round }}
                                </div>

                                @for($i = 0; $i < $matchesInRound; $i++)
                                    @php
                                        $game = $roundGames[$i] ?? null;

                                        if ($is1v1) {
                                            $p1 = $game ? $game->player1 : null;
                                            $p2 = $game ? $game->player2 : null;
                                            $w1 = $game && $game->winner_player_id === ($game->player1_id ?? null);
                                            $w2 = $game && $game->winner_player_id === ($game->player2_id ?? null);
                                        } else {
                                            $p1 = $game ? $game->team1 : null;
                                            $p2 = $game ? $game->team2 : null;
                                            $w1 = $game && $game->winner_id === ($game->team1_id ?? null);
                                            $w2 = $game && $game->winner_id === ($game->team2_id ?? null);
                                        }

                                        $t1 = $label($p1);
                                        $t2 = $label($p2);

                                        $isFinalRound = $round === $totalRounds;
                                        $isChampion = false;

                                        if ($isFinalRound && $game) {
                                            if ($is1v1) {
                                                $isChampion = !is_null($game->winner_player_id);
                                            } else {
                                                $isChampion = !is_null($game->winner_id);
                                            }
                                        }
                                    @endphp

                                    <div class="match">
                                        <div class="seed {{ $w1 ? 'winner' : '' }}">{{ $t1 }}</div>
                                        <div class="seed {{ $w2 ? 'winner' : '' }}">{{ $t2 }}</div>

                                        {{-- Conector hacia la siguiente ronda (solo si no es la última) --}}
                                        @if($round < $totalRounds)
                                            <div class="connector">
                                                <span class="line up"></span>
                                                <span class="line mid"></span>
                                                <span class="line down"></span>
                                            </div>
                                        @endif

                                        {{-- Mostrar campeón --}}
                                        @if($isChampion)
                                            <div class="champion-banner">
                                                🏆 {{ $w1 ? $t1 : $t2 }} — <span class="champion-text">Ganador del Torneo</span>
                                            </div>
                                        @endif

                                        {{-- Form admin para asignar ganador --}}
                                        @if($game && auth()->user()->role === 'admin')
                                            @if($is1v1 && is_null($game->winner_player_id))
                                                <form action="{{ route('tournaments.setWinner', ['game' => $game->id]) }}" method="POST" class="set-winner">
                                                    @csrf
                                                    <select name="winner_player_id" class="select">
                                                        @if($p1)<option value="{{ $p1->id }}">{{ $label($p1) }}</option>@endif
                                                        @if($p2)<option value="{{ $p2->id }}">{{ $label($p2) }}</option>@endif
                                                    </select>
                                                    <button type="submit" class="btn-confirm">OK</button>
                                                </form>
                                            @elseif(!$is1v1 && is_null($game->winner_id))
                                                <form action="{{ route('tournaments.setWinner', ['game' => $game->id]) }}" method="POST" class="set-winner">
                                                    @csrf
                                                    <select name="winner_id" class="select">
                                                        @if($p1)<option value="{{ $p1->id }}">{{ $label($p1) }}</option>@endif
                                                        @if($p2)<option value="{{ $p2->id }}">{{ $label($p2) }}</option>@endif
                                                    </select>
                                                    <button type="submit" class="btn-confirm">OK</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                @endif
            </div>
=======
            {{-- BRACKETS (sin cambios estructurales, ya incluías lógica robusta) --}}
            {{-- ... resto del código que ya tienes para mostrar llaves y partidas ... --}}
>>>>>>> 4302d7e3ddabe5ba475e2ada0bb399f36d8c99b4
        </div>
    </div>
</x-app-layout>
