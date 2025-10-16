<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlayerProfile;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function panel()
    {
        $players = PlayerProfile::with('user')
            ->orderBy('summoner_name', 'asc')
            ->get();

        return view('administrator', compact('players'));
    }

    public function mintDomicoins(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = User::findOrFail($data['user_id']);
        $wallet = $user->wallet()->firstOrCreate([], ['balance' => 0]);

        $wallet->balance += $data['amount'];
        $wallet->save();

        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'mint',
            'amount' => $data['amount'],
            'balance_snapshot' => $wallet->balance,
            'description' => 'Mint by admin',
            'reference_id' => Str::uuid(),
        ]);

        return back()->with('success', 'Domicoins cargados exitosamente.');
    }
}
