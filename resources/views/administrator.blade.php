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
    </div>
</x-app-layout> 
