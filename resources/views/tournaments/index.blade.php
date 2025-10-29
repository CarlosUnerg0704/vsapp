<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Torneos
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            {{-- Filtros --}}
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-lg font-semibold text-gray-700">
                    <span class="text-indigo-600">Filtrar:</span>
                </div>

                <div class="flex space-x-2">
                    <button onclick="filterTournaments('all')"
                            class="filter-btn px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">
                        Todos
                    </button>
                    <button onclick="filterTournaments('registro')"
                            class="filter-btn px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition active">
                        Registrando
                    </button>
                    <button onclick="filterTournaments('en_proceso')"
                            class="filter-btn px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md transition">
                        En Proceso
                    </button>
                    <button onclick="filterTournaments('finalizado')"
                            class="filter-btn px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                        Finalizados
                    </button>
                </div>
            </div>

            @if ($tournaments->isEmpty())
                <p id="noTournamentsMsg" class="text-gray-500 text-center mt-20">
                    Aún no hay torneos disponibles.
                </p>
            @else
                <div id="tournamentList" class="flex flex-col gap-6">
                    @foreach ($tournaments as $tournament)
                        @php
                            $scheduled = \Carbon\Carbon::parse($tournament->scheduled_at)->timezone(config('app.timezone'));
                            $status = $tournament->status; // ← nuevo status calculado
                            $showUrl = route('tournaments.show', $tournament->id);
                        @endphp

                        <div class="relative tournament-card flex bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 transition hover:shadow-xl"
                             data-status="{{ $status }}"
                             style="{{ $status !== 'registro' ? 'display:none;' : '' }}">

                            <a href="{{ $showUrl }}" class="absolute inset-0 z-0" aria-label="Ver torneo"></a>

                            <div class="w-40 h-40 flex-shrink-0 bg-gray-200 flex items-center justify-center text-gray-400 z-10">
                                <span class="text-xs select-none">[ Imagen del Torneo ]</span>
                            </div>

                            <div class="p-5 flex flex-col justify-between w-full z-10">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        <a href="{{ $showUrl }}" class="hover:underline">
                                            {{ $tournament->name }}
                                        </a>
                                    </h3>

                                    <div class="mt-2 text-sm text-gray-600 space-y-1">
                                        <p><strong>Formato:</strong> {{ strtoupper($tournament->type) }}</p>
                                        <p><strong>Fecha:</strong> {{ $scheduled->format('Y-m-d') }}</p>
                                        <p><strong>Hora:</strong> {{ $scheduled->format('H:i') }}</p>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mt-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @switch($status)
                                            @case('registro') bg-green-100 text-green-800 @break
                                            @case('en_proceso') bg-yellow-100 text-yellow-800 @break
                                            @case('finalizado') bg-red-100 text-red-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch">
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </span>

                                    <a href="{{ $showUrl }}"
                                       class="relative z-10 inline-block text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p id="noResultsMsg" class="text-gray-500 text-center mt-20 hidden">
                    No hay torneos disponibles en esta categoría.
                </p>
            @endif
        </div>
    </div>

    <style>
        .filter-btn.active { box-shadow: 0 0 0 3px rgba(99,102,241,0.45); }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => filterTournaments('registro'));

        function filterTournaments(filter) {
            const cards = document.querySelectorAll('.tournament-card');
            const noResultsMsg = document.getElementById('noResultsMsg');

            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            const match = Array.from(document.querySelectorAll('.filter-btn'))
                .find(btn => btn.textContent.trim().toLowerCase().includes(filter.replace('_', ' ')));
            if (match) match.classList.add('active');

            let visible = 0;
            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                if (filter === 'all' || filter === status) {
                    card.style.display = 'flex';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            noResultsMsg.classList.toggle('hidden', visible > 0);
        }
    </script>
</x-app-layout>
