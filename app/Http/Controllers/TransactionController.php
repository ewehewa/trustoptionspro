<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function showTransactions()
    {
        $user = Auth::user();

        $deposits = $user->deposits()->latest()->paginate(10);
        $withdrawals = $user->withdrawals()->latest()->paginate(10);

        return view('dashboard.user.transactions', compact('withdrawals', 'deposits'));
    }
}
