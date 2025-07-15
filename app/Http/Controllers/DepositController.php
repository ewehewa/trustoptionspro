<?php

namespace App\Http\Controllers;

use App\Mail\DepositReceived;
use App\Models\Deposit;
use App\Models\Wallet;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
    public function showDepositForm()
    {
        $totalDeposit = Auth::user()->deposits()->sum('amount');
        return view('dashboard.user.deposit', compact('totalDeposit'));
    }

    public function createDeposit(Request $request, CloudinaryService $cloudinaryService)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:50',
                'payment_mode' => 'required|string|max:100',
                'payment_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            ]);

            $user = Auth::user();
            $file = $request->file('payment_proof');

            if (!$file) {
                return response()->json([
                    'success' => false,
                    'message' => 'No payment proof file uploaded.',
                ], 400);
            }

            // Upload to Cloudinary via service
            $uploadedFileUrl = $cloudinaryService->uploadFile($file->getRealPath());

            if (!$uploadedFileUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'Upload to Cloudinary failed. Try again later.',
                ], 500);
            }

            // Save to database
            $deposit = Deposit::create([
                'user_id'       => $user->id,
                'amount'        => $request->amount,
                'payment_mode'  => $request->payment_mode,
                'payment_proof' => $uploadedFileUrl,
            ]);

            // Send email notification
            Mail::to($user->email)->send(new DepositReceived($deposit));

            return response()->json([
                'success' => true,
                'message' => 'Deposit submitted successfully. Please wait for approval.',
            ]);

        } catch (\Exception $e) {
            Log::error('Deposit error', [
                'message' => $e->getMessage(),
                'user_id' => Auth::id(),
                'input'   => $request->except('payment_proof'),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your deposit. Try again.',
            ], 500);
        }
    }

    public function showCompleteDeposit()
    {
        $wallets = Wallet::latest()->get();
        return view("dashboard.user.confirm_deposit", compact("wallets"));
    }
}
