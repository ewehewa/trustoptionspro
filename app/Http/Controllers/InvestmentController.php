<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\InvestmentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\InvestmentSuccessfulMail;

class InvestmentController extends Controller
{
    public function showInvestments()
    {
        $user = request()->user();

        $investments = $user->investments()
            ->with('plan')
            ->latest()
            ->get();

        return view('dashboard.user.investments', compact('investments'));
    }

    public function showPlans()
    {
        $plans = InvestmentPlan::latest()->get();
        return view('dashboard.user.plans', compact('plans'));
    }

    public function invest(Request $request)
    {
        try {
            $validated = $request->validate([
                'plan_id' => 'required|exists:investment_plans,id',
                'amount' => 'required|numeric|min:1',
            ]);

            $user = Auth::user();

            $plan = InvestmentPlan::findOrFail($validated['plan_id']);
            $amount = $validated['amount'];

            // Validate amount range
            if ($amount < $plan->min_amount || $amount > $plan->max_amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Investment amount must be between $' . number_format($plan->min_amount) . ' and $' . number_format($plan->max_amount),
                ], 422);
            }

            // Check balance
            if ($user->balance < $amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance to invest.',
                ], 422);
            }

            DB::beginTransaction();

            // Deduct balance
            $user->decrement('balance', $amount);

            // Create investment
            $investment = Investment::create([
                'user_id' => $user->id,
                'investment_plan_id' => $plan->id,
                'amount' => $amount,
            ]);

            // Send mail
            Mail::to($user->email)->send(new InvestmentSuccessfulMail($investment));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Investment successful. A confirmation email has been sent.',
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
