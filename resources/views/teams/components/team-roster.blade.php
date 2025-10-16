<div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $team->name }} - Management
                        @if(session('status'))
                            <div class="alert alert-success mt-2">
                                {{ session('status') }}
                            </div>
                        @endif
                    </h2>
                    <p class="text-sm text-gray-500">
                        Manage team roles and roster, review detailed match history, and track performance statistics.
                    </p>
                    
                   
                   
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Teams data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                   @foreach($team->players as $player)
                                    <tr>
                                        <td>{{ $player->profile->summoner_name ?? '-' }}</td>

                                        <td>
                                            @if(auth()->user()->role === 'captain' && auth()->user()->current_team_id === $team->id)
                                                <form action="{{ route('teams.updateRole', [$team->id, $player->id]) }}" method="POST">
                                                    @csrf
                                                    <select name="role" class="form-control form-control-sm" onchange="this.form.submit()">
                                                        <option value="*" {{ empty($player->profile->role) ? 'selected' : '' }}>*</option>
                                                        <option value="Top Lane" {{ $player->profile->role === 'Top Lane' ? 'selected' : '' }}>Top Lane</option>
                                                        <option value="Jungle" {{ $player->profile->role === 'Jungle' ? 'selected' : '' }}>Jungle</option>
                                                        <option value="Mid Lane" {{ $player->profile->role === 'Mid Lane' ? 'selected' : '' }}>Mid Lane</option>
                                                        <option value="Bot Lane" {{ $player->profile->role === 'Bot Lane' ? 'selected' : '' }}>Bot Lane</option>
                                                        <option value="Support" {{ $player->profile->role === 'Support' ? 'selected' : '' }}>Support</option>
                                                    </select>
                                                </form>
                                            @else
                                                {{ $player->profile->role ?? '-' }}
                                            @endif
                                        </td>

                                        <td>
                                            @if(auth()->user()->role === 'captain' && auth()->user()->current_team_id === $team->id)
                                                <form action="{{ route('teams.kick', [$team->id, $player->id]) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">Despedir</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                       
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div> 