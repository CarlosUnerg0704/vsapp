<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administrador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="col-xl-8 col-lg-7">
                <form action="{{ route('admin.mint') }}" method="POST" id="mintForm">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Seleccionar jugador</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">-- Selecciona un jugador --</option>
                            @foreach($players as $player)
                                <option value="{{ $player->user->id }}">
                                    {{ $player->summoner_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Cantidad de Domicoins</label>
                        <input type="number" class="form-control" name="amount" required min="0.01" step="0.01">
                    </div>
                    <button type="submit" class="btn btn-primary">Cargar Domicoins</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4 mt-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Crear Torneo</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('tournaments.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name">Nombre del torneo:</label>
                <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="date">Fecha:</label>
                <input type="date" name="date" id="date" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="time">Hora:</label>
                <input type="time" name="time" id="time" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="type">Tipo de torneo:</label>
                <select name="type" id="type" class="form-select mt-1 block w-full" required>
                    <option value="1vs1">1 vs 1</option>
                    <option value="5vs5">5 vs 5</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded">Crear Torneo</button>
        </form>

    </div>
</div>

    </div>
</x-app-layout> 
