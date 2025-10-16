<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DominioLoL</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-text mx-3">DomainLOL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Summary</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Community
            </div>

            <!-- Nav Item - Players -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pList') }}">
                    <i class="fas fa-user-alt"></i>
                    <span>Players</span></a>
            </li>

            <!-- Nav Item - Teams -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tList') }}">
                    <i class="fas fa-users"></i>
                    <span>Teams</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{ asset('img/undraw_rocket.svg') }}" alt="...">
                <p class="text-center mb-2"><strong>Find Match 1 vs 1</strong> Only Two People in an Arena, Establish Your Domain</p>
                <a class="btn btn-success btn-sm" href="{{ url('/dashboard') }}">Find Match</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">
                                    {{ Auth::user()->receivedInvitations()->where('status', 'pending')->count() }}
                                </span>
                            </a>

                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">Message Center</h6>

                                @php
                                    $pendingReceived = Auth::user()->receivedInvitations()
                                        ->where('status','pending')
                                        ->with(['sender','team'])
                                        ->latest()
                                        ->take(10)
                                        ->get();

                                    $answeredSent = Auth::user()->sentInvitations()
                                        ->whereIn('status',['accepted','rejected'])
                                        ->with(['receiver','team'])
                                        ->latest()
                                        ->take(10)
                                        ->get();
                                @endphp

                                {{-- Invitaciones recibidas pendientes --}}
                                @forelse($pendingReceived as $invite)
                                    <div class="dropdown-item d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-users text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{ $invite->created_at->diffForHumans() }}</div>
                                            <div>
                                                <strong>{{ $invite->sender->name }}</strong> invited you to join 
                                                <strong>{{ $invite->team->name }}</strong>
                                            </div>
                                            <div class="mt-2">
                                                <form action="{{ route('invitations.accept', $invite->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Accept</button>
                                                </form>
                                                <form action="{{ route('invitations.reject', $invite->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                                {{-- Respuestas a invitaciones enviadas por mí --}}
                                @forelse($answeredSent as $invite)
                                    <div class="dropdown-item d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle {{ $invite->status === 'accepted' ? 'bg-success' : 'bg-danger' }}">
                                                @if($invite->status === 'accepted')
                                                    <i class="fas fa-check-circle text-white"></i>
                                                @else
                                                    <i class="fas fa-times-circle text-white"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{ $invite->updated_at->diffForHumans() }}</div>
                                            @if($invite->status === 'accepted')
                                                <div><strong>{{ $invite->receiver->name }}</strong> accepted your invitation to join <strong>{{ $invite->team->name }}</strong>.</div>
                                            @else
                                                <div><strong>{{ $invite->receiver->name }}</strong> rejected your invitation to join <strong>{{ $invite->team->name }}</strong>.</div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                                @if($pendingReceived->isEmpty() && $answeredSent->isEmpty())
                                    <p class="text-center text-gray-500 px-3">No new messages.</p>
                                @endif
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    @if(Auth::check()) {{ Auth::user()->name }} @endif
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('rPlayer') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Player
                                </a>
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                <a class="dropdown-item" href="{{ route('admin.panel') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Administrator Panel
                                </a>
                                @endif
                                

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                {{ $slot }}
                <!-- /.container-fluid -->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; DomainLOL 2024</span>
                    </div>
                </div>
            </footer>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
</body>
</html>
