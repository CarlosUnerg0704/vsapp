<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Torneo: {{ $tournament->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Detalles del torneo --}}
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-2">Detalles</h3>
                <p><strong>Tipo:</strong> {{ strtoupper($tournament->type) }}</p>
                <p><strong>Fecha y Hora:</strong> {{ \Carbon\Carbon::parse($tournament->scheduled_at)->format('d/m/Y H:i') }}</p>
            </div>

            {{-- Botón de registro / abandono --}}
            @if (auth()->check() && in_array(auth()->user()->role, ['player', 'captain']))
                <div class="mb-6">
                    @if ($registrationOpen)
                        @if ($userRegistered)
                            <form action="{{ route('tournaments.unregister', $tournament->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Abandonar Torneo
                                </button>
                            </form>
                        @else
                            <form action="{{ route('tournaments.register', $tournament->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Registrarse
                                </button>
                            </form>
                        @endif
                    @else
                        <p class="text-gray-500">El registro está cerrado.</p>
                    @endif
                </div>
            @endif

            {{-- Lista de participantes --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Participantes ({{ $registeredUsers->count() }})</h3>
                @if ($registeredUsers->isEmpty())
                    <p class="text-gray-500">No hay participantes aún.</p>
                @else
                    <ul class="list-disc list-inside">
                        @foreach ($registeredUsers as $reg)
                            <li>
                                {{ $reg->user->profile->summoner_name ?? $reg->user->name }}
                                @if ($reg->user->current_team_id)
                                    — Equipo: {{ optional($reg->user->team)->name }}
                                @else
                                    — (Free Agent)
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Llaves generadas --}}
            <div>
                <h3 class="text-lg font-semibold mb-2">Llaves Generadas</h3>
                @if (isset($games) && $games->count() > 0)
                    <div class="space-y-4">
                        @foreach ($games as $game)
                            <div class="p-3 bg-gray-100 rounded">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <strong>
                                            {{ $game->player1->profile->summoner_name ?? $game->player1->name ?? 'Free Agent' }}
                                        </strong>
                                        (Equipo: {{ optional($game->team1)->name ?? 'Sin equipo' }})
                                        &nbsp;vs&nbsp;
                                        <strong>
                                            {{ $game->player2->profile->summoner_name ?? $game->player2->name ?? 'Free Agent' }}
                                        </strong>
                                        (Equipo: {{ optional($game->team2)->name ?? 'Sin equipo' }})
                                    </div>
                                    {{-- Aquí podrías agregar botones para registrar ganador si quieres --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400">Aún no se han generado llaves.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
