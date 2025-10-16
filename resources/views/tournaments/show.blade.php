<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Torneo: {{ $tournament->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 px-4">
        <p class="mb-4">Fecha: {{ $tournament->date }} | Hora: {{ $tournament->time }}</p>

        @if($isRegistered)
            <form action="{{ route('tournaments.unregister', $tournament->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Abandonar Torneo</button>
            </form>
        @else
            <form action="{{ route('tournaments.register', $tournament->id) }}" method="POST">
                @csrf
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Registrarse</button>
            </form>
        @endif

        <h3 class="mt-8 text-lg font-semibold">Participantes</h3>
        <ul class="list-disc pl-5 mt-2">
            @foreach($tournament->registrations as $reg)
                <li>{{ $reg->user->profile->summoner_name ?? $reg->user->name }}</li>
            @endforeach
        </ul>

        <!-- Aquí más adelante se puede renderizar el bracket (llaves) -->
    </div>
</x-app-layout>

