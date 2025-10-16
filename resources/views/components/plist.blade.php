<!-- FLASH MESSAGE -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Players List</h1>
                    <p class="mb-4">The section displays key player data, including names, games won and lost, and the teams they're part of. This professional layout streamlines data analysis and tracking.</p>

                    
                   
                   
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Players List</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered w-full">
                            <thead>
                                <tr>
                                    <th>Summoner Name</th>
                                    <th>Rank</th>
                                    <th>Team</th>
                                    <th>Games Won</th>
                                    <th>Games Lost</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($players as $player)
                                    @if ($player->profile)
                                    <tr>
                                        <td>{{ $player->profile->summoner_name ?? $player->name }}</td>
                                        <td>{{ $player->profile->rank ?? '-' }}</td>
                                        <td>{{ $player->currentTeam ? $player->currentTeam->name : 'Free Agent' }}</td>
                                        <td>{{ $player->g_win ?? 0 }}</td>
                                        <td>{{ $player->g_lost ?? 0 }}</td>
                                        <td>{{ $player->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            @if(Auth::check() && Auth::user()->isCaptain())
                                                <form action="{{ route('invitations.send') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="receiver_id" value="{{ $player->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary">Invite</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 