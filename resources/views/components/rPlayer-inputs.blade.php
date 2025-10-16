@php
    /** @var \App\Models\PlayerProfile|null $profile */
    $isEdit = !is_null($profile);
    $riotIdValue = old('riot_id', $profile ? ($profile->riot_game_name . '#' . $profile->riot_tag_line) : '');
    $platformValue = old('platform', $profile->platform ?? '');
@endphp

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Registro como Jugador</h1>
    <p class="mb-4">
        Ingresa tu <strong>Riot ID</strong> con el formato <code>GameName#TagLine</code> y selecciona tu servidor.
        El sistema validará tu cuenta y traerá automáticamente tu rango (SoloQ).
    </p>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Información del Jugador</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ $isEdit ? route('player.update') : route('player.register') }}">
                        @csrf
                        @if ($isEdit) @method('PUT') @endif

                        <div class="form-group mb-3">
                            <label for="riot_id">Riot ID (GameName#TagLine) <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="riot_id"
                                   id="riot_id"
                                   class="form-control"
                                   required
                                   placeholder="TuNombre#TAG"
                                   value="{{ $riotIdValue }}">
                            <small class="form-text text-muted">
                                Ejemplo: <code>Faker#KR1</code>. Debe incluir el símbolo <strong>#</strong>.
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="platform">Servidor <span class="text-danger">*</span></label>
                            <select name="platform" id="platform" class="form-control" required>
                              <option value="">Selecciona tu servidor</option>
                              <option value="la1" {{ $platformValue === 'la1' ? 'selected' : '' }}>LAN (Latinoamérica Norte)</option>
                              <option value="la2" {{ $platformValue === 'la2' ? 'selected' : '' }}>LAS (Latinoamérica Sur)</option>
                              {{-- agrega estos si ampliaste la validación --}}
                              <option value="na1" {{ $platformValue === 'na1' ? 'selected' : '' }}>NA (Norteamérica)</option>
                              <option value="br1" {{ $platformValue === 'br1' ? 'selected' : '' }}>BR (Brasil)</option>
                            </select>

                        </div>

                        <div class="form-group mb-3">
                            <label for="country">País <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="country"
                                   id="country"
                                   class="form-control"
                                   required
                                   value="{{ old('country', $profile->country ?? '') }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone">Número de Teléfono <span class="text-danger">*</span></label>
                            <input type="tel"
                                   name="phone"
                                   id="phone"
                                   class="form-control"
                                   required
                                   pattern="[0-9+()\-\\s]{7,20}"
                                   value="{{ old('phone', $profile->phone ?? '') }}">
                            <small class="form-text text-muted">Ej.: 3001234567, +57 300 123 4567</small>
                        </div>

                        {{-- Rank solo lectura (cuando existe) --}}
                        @if($isEdit && ($profile->rank_tier || $profile->rank_division))
                            <div class="form-group mb-3">
                                <label>Rango (SoloQ)</label>
                                <input type="text" class="form-control" readonly
                                       value="{{ trim(($profile->rank_tier ?? '') . ' ' . ($profile->rank_division ?? '')) }} ({{ $profile->rank_lp ?? 0 }} LP)">
                            </div>
                        @elseif($isEdit && $profile->rank)
                            <div class="form-group mb-3">
                                <label>Rango (SoloQ)</label>
                                <input type="text" class="form-control" readonly value="{{ $profile->rank }}">
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Actualizar' : 'Registrar jugador' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
