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

            {{-- BRACKETS (sin cambios estructurales, ya incluías lógica robusta) --}}
            {{-- ... resto del código que ya tienes para mostrar llaves y partidas ... --}}
        </div>
    </div>
</x-app-layout>
