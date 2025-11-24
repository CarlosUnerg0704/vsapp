<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administrador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- FLASH --}}
            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 rounded bg-red-50 text-red-700 px-4 py-2">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- CARGAR DOMICOINS --}}
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4">Cargar Domicoins</h3>
                <form action="{{ route('admin.mint') }}" method="POST" id="mintForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="user_id" class="block text-sm font-medium">Seleccionar jugador</label>
                        <select name="user_id" id="user_id" class="form-select mt-1 block w-full" required>
                            @foreach(\App\Models\User::orderBy('name')->get() as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="amount" class="block text-sm font-medium">Cantidad de Domicoins</label>
                        <input type="number" class="form-input mt-1 block w-full" name="amount" required min="0.01" step="0.01">
                    </div>
                    <button type="submit" class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded">Cargar</button>
                </form>
            </div>

            {{-- CREAR TORNEO --}}
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4">Crear Torneo</h3>
                <form action="{{ route('tournaments.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium">Nombre del torneo</label>
                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
                    </div>

<<<<<<< HEAD
                    <div>
                        <label for="entry_fee" class="block text-sm font-medium">Costo de entrada (Domicoins)</label>
                        <input type="number" name="entry_fee" id="entry_fee" step="0.01" min="0" class="form-input mt-1 block w-full"required>
                    </div>


=======
>>>>>>> 4302d7e3ddabe5ba475e2ada0bb399f36d8c99b4
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="date" class="block text-sm font-medium">Fecha</label>
                            <input type="date" name="date" id="date" class="form-input mt-1 block w-full" required min="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div>
                            <label for="time" class="block text-sm font-medium">Hora</label>
                            <input type="time" name="time" id="time" class="form-input mt-1 block w-full" required>
                        </div>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium">Formato</label>
                        <select name="type" id="type" class="form-select mt-1 block w-full" required>
                            <option value="1vs1">1 vs 1</option>
                            <option value="5vs5">5 vs 5</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded">
                        Crear Torneo
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
