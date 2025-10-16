<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Summary</h1>
    </div>

    <!-- Row: Quick Stats -->
    <div class="row">

        <!-- RP Today -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Domicoins Ganados Hoy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $domicoinsToday }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RP This Week -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Domicoins Ganados esta Semana</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $domicoinsThisWeek }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Domicoins En Espera</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $domicoinsPending }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Teams -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Domicoins Disponibles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $domicoinsAvailable }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Row: Tournaments & Top Players -->
    <div class="row">

        <!-- Upcoming Tournaments & News -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upcoming Tournaments & News</h6>
                </div>
                <div class="card-body">
                    <p>No tournaments or news available yet.</p>
                </div>
            </div>
        </div>

        <!-- Top 3 Players by Winrate -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Top 3 Players by Winrate</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Player</th>
                    <th>Winrate</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topPlayers as $player)
                    <tr>
                        <td>{{ $player->profile->summoner_name ?? $player->name }}</td>
                        <td>{{ $player->winrate }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">No data yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


    </div>

    <!-- Row: Recent Games & Top Teams -->
    <div class="row">

        <!-- Recent Games -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Games</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Match</th>
                                <th>Winner</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentGames as $game)
                                <tr>
                                    <td>{{ $game->team1->name }} vs {{ $game->team2->name }}</td>
                                    <td>
                                        <span class="badge {{ $game->winner_id == $game->team1_id ? 'bg-success' : 'bg-danger' }}">
                                            {{ $game->winner->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $game->played_at?->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No games recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Top 3 Teams -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top 3 Teams (Win Rate)</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($topTeams as $team)
                            <li class="list-group-item">
                                {{ $team->name }} - {{ $team->winrate }}%
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">
                                No teams yet.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>


    </div>

</div>
