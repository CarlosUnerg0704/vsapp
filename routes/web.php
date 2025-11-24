<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerProfileController;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamInvitationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TournamentController;

/*
|--------------------------------------------------------------------------
| Web Routes

|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('pList', [VistasController::class, 'pList'])->name('pList');

//vistas de los teams
Route::get('tList', [TeamController::class, 'tList'])->name('tList');
Route::get('/teams/{id}', [TeamController::class, 'show'])->name('teams.show');

//invitaciones de los equipos
Route::middleware(['auth'])->group(function () {
    Route::post('/invitations/send',   [TeamInvitationController::class, 'send'])->name('invitations.send');
    Route::post('/invitations/{id}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
    Route::post('/invitations/{id}/reject', [TeamInvitationController::class, 'reject'])->name('invitations.reject');
});

//DESPEDIR O DESVINCULAR JUGADOR DEL EQUIPO
Route::post('/teams/{team}/kick/{player}', [TeamController::class, 'kickPlayer'])
    ->middleware(['auth'])
    ->name('teams.kick');

//Actualizar el ROL del jugador
Route::post('/teams/{team}/players/{player}/update-role', [TeamController::class, 'updateRole'])
->middleware(['auth'])
->name('teams.updateRole');

//VISTA DEL ADMINISTRADOR
Route::prefix('admin')
    ->middleware(['auth', 'is_admin']) // Asegura autenticación y rol de admin
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'panel'])->name('panel');
        Route::post('/mint', [AdminController::class, 'mintDomicoins'])->name('mint');
    });

//Vista de Torneos
Route::middleware(['auth'])->prefix('tournaments')->name('tournaments.')->group(function () {
Route::get('/', [TournamentController::class, 'index'])->name('index');
Route::post('/{id}/register', [TournamentController::class, 'register'])->name('register');
Route::post('/{id}/unregister', [TournamentController::class, 'unregister'])->name('unregister');
Route::get('/{id}', [TournamentController::class, 'show'])->name('show');
Route::post('/game/{game}/set-winner', [TournamentController::class, 'setWinner'])->name('setWinner');
});


// Admin creation routes
Route::middleware(['auth', 'is_admin'])->group(function () {
Route::get('/admin/create-tournament', [TournamentController::class, 'create'])->name('tournaments.create');
Route::post('/admin/store-tournament', [TournamentController::class, 'store'])->name('tournaments.store');
});



// Registro y edición de perfil de jugador
Route::get('rPlayer', [PlayerProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('rPlayer');

Route::post('/registro-jugador', [PlayerProfileController::class, 'store'])
    ->middleware('auth')
    ->name('player.register');

Route::put('/registro-jugador', [PlayerProfileController::class, 'update'])
    ->middleware('auth')
    ->name('player.update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
