<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        $amount = (float) $validated['amount'];

        DB::transaction(function () use ($user, $amount) {
            // record the bonus
            $user->bonuses()->create(['amount' => $amount]);

            // increment balance
            $user->increment('balance', $amount);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Bonus added successfully',
            'user_id' => $user->id,
            'new_balance' => $user->fresh()->balance,
        ]);
    }

    // ➖ Remove Bonus
    public function destroy(Request $request, User $user)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        $amount = (float) $validated['amount'];

        // Get user's current bonus balance
        $bonusBalance = $user->bonuses()->sum('amount');

        if ($bonusBalance < $amount) {
            return response()->json([
                'status' => 'error',
                'message' => 'User does not have enough bonus balance to remove',
            ], 422);
        }

        DB::transaction(function () use ($user, $amount) {
            // Record a negative bonus entry (debit)
            $user->bonuses()->create([
                'amount' => -$amount
            ]);

            $user->decrement('balance', $amount); // <-- you need this line
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Bonus removed successfully',
            'user_id' => $user->id,
            'new_bonus_balance' => $user->fresh()->balance, // updated bonus balance
        ]);
    }

}
