<?php

namespace App\Http\Controllers;

use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamInvitationController extends Controller
{
    // Capitán invita a un jugador
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
        ]);

        $captain = Auth::user();

        // Debe ser capitán
        if ($captain->role !== 'captain') {
            return back()->withErrors(['error' => 'Only captains can send invitations.']);
        }

        // Debe tener equipo asignado
        if (!$captain->current_team_id) {
            return back()->withErrors(['error' => 'Captain has no team assigned.']);
        }

        // No puede invitarse a sí mismo
        if ((int)$request->receiver_id === (int)$captain->id) {
            return back()->withErrors(['error' => 'You cannot invite yourself.']);
        }

        $receiver = User::findOrFail($request->receiver_id);
        $teamId   = (int)$captain->current_team_id;

        // Ya está en el mismo equipo
        if ((int)$receiver->current_team_id === $teamId) {
            return back()->withErrors(['error' => 'This player is already in your team.']);
        }

        // Evitar duplicados pendientes para el mismo equipo
        $existsPending = TeamInvitation::where('receiver_id', $receiver->id)
            ->where('team_id', $teamId)
            ->where('status', 'pending')
            ->exists();

        if ($existsPending) {
            return back()->with('info', 'There is already a pending invitation for this player.');
        }

        TeamInvitation::create([
            'sender_id'   => $captain->id,
            'receiver_id' => $receiver->id,
            'team_id'     => $teamId,
            'status'      => 'pending',
        ]);

        $label = optional($receiver->profile)->summoner_name ?? $receiver->name;

        return back()->with('success', "Invitation sent to {$label}.");
    }

    // Jugador acepta -> sobreescribe su current_team_id con el team de la invitación
    public function accept($id)
    {
        $invitation = TeamInvitation::with(['receiver', 'team'])->findOrFail($id);

        if ((int)$invitation->receiver_id !== (int)Auth::id()) {
            return back()->withErrors(['error' => 'You cannot act on this invitation.']);
        }

        DB::transaction(function () use ($invitation) {
            // marcar como aceptada
            $invitation->update(['status' => 'accepted']);

            // FORZAR overwrite (evita problemas de $fillable/guarded)
            $invitation->receiver->forceFill([
                'current_team_id' => $invitation->team_id,
            ])->save();

            // rechazar otras invitaciones PENDIENTES del mismo jugador
            TeamInvitation::where('receiver_id', $invitation->receiver_id)
                ->where('status', 'pending')
                ->where('id', '!=', $invitation->id)
                ->update(['status' => 'rejected']);
        });

        return back()->with('success', "You joined team {$invitation->team->name}.");
    }

    public function reject($id)
    {
        $invitation = TeamInvitation::with(['receiver', 'team'])->findOrFail($id);

        if ((int)$invitation->receiver_id !== (int)Auth::id()) {
            return back()->withErrors(['error' => 'You cannot act on this invitation.']);
        }

        $invitation->update(['status' => 'rejected']);

        return back()->with('success', "Invitation from team {$invitation->team->name} rejected.");
    }
}
