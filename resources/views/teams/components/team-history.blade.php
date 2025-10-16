<div class="container-fluid">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Historial de Juegos</h6>
                            <span class="badge bg-success">
                                W/L: {{ $team->g_win }} / {{ $team->g_lost }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Oponente</th>
                                            <th>Resultado</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   @forelse($team->allGames() as $game)
                                        <tr>
                                            <td>
                                                {{ $game->team1_id == $team->id ? $game->team2->name : $game->team1->name }}
                                            </td>
                                            <td>
                                                @if($game->winner_id == $team->id)
                                                    <span class="badge bg-success">Victoria</span>
                                                @else
                                                    <span class="badge bg-danger">Derrota</span>
                                                @endif
                                            </td>
                                            <td>{{ $game->played_at?->diffForHumans() }}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                No hay juegos registrados aún.
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
