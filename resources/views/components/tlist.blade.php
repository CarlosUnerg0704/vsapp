
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Teams Overview</h1>
                    <p class="mb-4">This section provides a summary of all registered teams, including their name, region, captain, and match performance (W/L). You can quickly compare team performance here and access detailed views to manage players or review match history.</p>

                    
                   
                   
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
                                            <th>Name</th>
                                            <th>Rank Solo</th>
                                            <th>Teams</th>
                                            <th>Win</th>
                                            <th>Lose</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Rank Solo</th>
                                            <th>Teams</th>
                                            <th>Win</th>
                                            <th>Lose</th>
                                            <th>Created</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($teams as $team)
                                         <tr>
                                            <td>
                                                <a href="{{ route('teams.show', $team->id) }}" class="text-blue-600 hover:underline">
                                                    {{ $team->name }}
                                                </a>
                                            </td>
                                            <td>{{ $team->rank }}</td>
                                            <td>-</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>{{ $team->created_at }}</td>
                                        </tr>
                                    @endforeach
                                       
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div> 