<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Torneos disponibles
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 px-4">
        <h3 class="text-lg font-semibold mb-4">Lista de Torneos</h3>
        <ul class="list-disc pl-5 space-y-2">
            @forelse($tournaments as $tournament)
                <li>
                    <a href="{{ route('tournaments.show', $tournament->id) }}" class="text-blue-600 hover:underline">
                        {{ $tournament->name }} - {{ $tournament->date }} {{ $tournament->time }}
                    </a>
                </li>
            @empty
                <li>No hay torneos disponibles.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
