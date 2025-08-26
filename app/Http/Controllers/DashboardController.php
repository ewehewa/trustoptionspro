<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalBonus = $user->bonuses()->sum('amount');

        return view('dashboard.user.index', compact('user', 'totalBonus'));
    }

    public function showProfile()
    {
        return view('dashboard.user.profile');
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
        ]);

        return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
    }

    Public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'currentPassword' => 'required|string',
                'newPassword' => 'required|string|min:6|confirmed',
            ]);

            $user = Auth::user();

            if (!Hash::check($request->currentPassword, $user->password)) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'currentPassword' => ['The current password is incorrect.']
                    ]
                ], 422);
            }

            $user->password = Hash::make($request->newPassword);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
