<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function showWithdrawalForm()
    {
        $user = Auth::user();
        return view('dashboard.user.withdraw', compact('user'));
    }

public function submitWithdrawal(Request $request) 
{
    $request->validate([
        'amount' => 'required|numeric|min:50',
        'method' => 'required|string',
        'address' => 'required|string',
        'otp' => 'required|string'
    ]);

    $user = Auth::user();

    if ($user->otp !== $request->otp) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP provided.'
        ], 422);
    }

    // Ensure user has enough balance
    if ($user->balance < $request->amount) {
        return response()->json([
            'success' => false,
            'message' => 'Insufficient balance.'
        ], 422);
    }

    DB::beginTransaction();

    try {
        // Clear OTP
        $user->otp = null;

        // Deduct amount from balance
        $user->balance -= $request->amount;
        $user->save();

        // Create withdrawal
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'receiving_mode' => $request->method,
            'address' => $request->address,
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Withdrawal request submitted successfully.'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Failed to submit withdrawal request. Try again later.'
        ], 500);
    }
}

    public function showWithdrawalHistory()
    {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(10);
        return view('dashboard.admin.withdrawal_history', compact('withdrawals'));
    }
}
