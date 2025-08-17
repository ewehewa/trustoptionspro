<?php

namespace App\Http\Controllers;

use App\Models\CopiedTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CopiedTraderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'trader_id' => 'required|exists:traders,id',
        ]);

        $user = Auth::user();

        // ✅ Check if user has funds
        if ($user->balance <= 0) {   // assuming you store balance in `users` table
            return response()->json([
                'success' => false,
                'message' => 'You need to fund your account before copying a trader.',
            ], 403);
        }

        // Check if already copied
        $exists = CopiedTrader::where('user_id', $user->id)
                    ->where('trader_id', $request->trader_id)
                    ->first();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You are already copying this trader.',
            ], 400);
        }

        CopiedTrader::create([
            'user_id'   => $user->id,
            'trader_id' => $request->trader_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'You are now copying this trader!',
        ]);
    }


    // Stop copying a trader
    public function destroy($id)
    {
        $user = Auth::user();

        $copied = CopiedTrader::where('user_id', $user->id)
                    ->where('trader_id', $id)
                    ->first();

        if (!$copied) {
            return response()->json([
                'success' => false,
                'message' => 'You are not copying this trader.',
            ], 404);
        }

        $copied->delete();

        return response()->json([
            'success' => true,
            'message' => 'You have stopped copying this trader.',
        ]);
    }

    public function history()
    {
        $user = Auth::user()->load([
            'copiedTraders' => function ($q) {
                $q->latest();
            },
            'copiedTraders.trader'
        ]);

        return view('dashboard.user.copiedTradeHistory', compact('user'));
    }
}
