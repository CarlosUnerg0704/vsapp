<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }} - Administración
        </h2>
    </x-slot>

    <div class="py-12 space-y-6">
        <!-- Roster -->
        @include('teams.components.team-roster', ['team' => $team])

        <!-- Historial de Juegos -->
        @include('teams.components.team-history', ['team' => $team])
    </div>
</x-app-layout>

