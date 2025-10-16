<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $tournament->name }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <p class="text-gray-600 mb-2">Fecha: <strong>{{ \Carbon\Carbon::parse($tournament->scheduled_at)->toDateString() }}</strong></p>
            <p class="text-gray-600 mb-4">Hora: <strong>{{ \Carbon\Carbon::parse($tournament->scheduled_at)->format('H:i') }}</strong></p>
            <p class="text-gray-600">Tipo: <strong>{{ strtoupper($tournament->type) }}</strong></p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            @if($isRegistered)
                <form action="{{ route('tournaments.unregister', $tournament->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Abandonar Torneo
                    </button>
                </form>
            @else
                <form action="{{ route('tournaments.register', $tournament->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Registrarse
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Participantes</h3>
            @if($tournament->registrations->isEmpty())
                <p class="text-gray-500">Aún no hay participantes</p>
            @else
                <ul class="list-disc list-inside space-y-1">
                    @foreach($tournament->registrations as $reg)
                        <li>{{ $reg->user->profile->summoner_name ?? $reg->user->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Llaves del Torneo</h3>
            <div id="bracket">
                {{-- Aquí puedes renderizar el bracket (logica JavaScript o Blade) --}}
            </div>
        </div>
    </div>
</x-app-layout>

