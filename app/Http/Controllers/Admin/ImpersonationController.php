<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function impersonate(User $user, Request $request)
    {
        // Store current admin ID so we can switch back later
        $request->session()->put('impersonate_admin_id', Auth::guard('admin')->id());

        // Login as the user (using default "web" guard)
        Auth::guard('web')->login($user);

        // Redirect directly to user dashboard (or "home")
        return redirect()->route('dashboard')
            ->with('success', "Now impersonating user {$user->name}");
    }

    /**
     * Stop impersonating and return to admin
     */
    public function leave(Request $request)
    {
        $adminId = $request->session()->pull('impersonate_admin_id');

        if ($adminId) {
            // Log back in as admin
            Auth::guard('admin')->loginUsingId($adminId);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Returned to admin account');
        }

        return redirect()->route('admin.dashboard')
            ->with('error', 'No impersonation session found.');
    }
}
