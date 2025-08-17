<?php

namespace App\Http\Controllers;

use App\Models\Trader;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    public function index()
    {
        $traders = Trader::with('copiedByUsers')->get();

        return view('dashboard.user.traders', compact('traders'));
    }
}
