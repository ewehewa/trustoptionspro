<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationCode;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Str;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view("auth.register", ['title' => 'Register']);
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'country' => 'required|string|max:100',
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
                ],
            ], [
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ]);

            // Check for existing email
            $existingEmail = User::where('email', $validated['email'])->first();

            if ($existingEmail && !$existingEmail->email_verified_at) {
                $existingEmail->email_otp = rand(100000, 999999);
                $existingEmail->otp_expires_at = now()->addMinutes(10);
                $existingEmail->save();

                Mail::to($existingEmail->email)->send(new EmailVerificationCode($existingEmail->email_otp));
                session(['pending_email_verification' => $existingEmail->email]);

                return response()->json([
                    'success' => true,
                    'message' => 'Email already registered but not verified. A new OTP has been sent.',
                    'redirect' => route('verify.email.show'),
                ]);
            }

            if ($existingEmail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email already in use. Please login',
                ], 422);
            }

            // Check for existing username
            $existingUsername = User::where('username', $validated['username'])->first();

            if ($existingUsername) {
                return response()->json([
                    'success' => false,
                    'message' => 'Username already taken. Please choose another.',
                ], 422);
            }

            // New user
            $otp = rand(100000, 999999);

            $user = User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'country' => $validated['country'],
                'access' => $validated['password'], // ⚠️ Do you really need to store raw password in `access`?
                'password' => Hash::make($validated['password']),
                'email_otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new EmailVerificationCode($otp));
            session(['pending_email_verification' => $user->email]);

            return response()->json([
                'success' => true,
                'message' => 'Account created. OTP sent to your email.',
                'redirect' => route('verify.email.show')
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Registration error', [
                'message' => $e->getMessage(),
                'input' => $request->except(['password', 'password_confirmation']),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }




    public function showLoginForm()
    {
        return view("auth.login", ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'login' => 'required|string', // can be email or username
                'password' => 'required|string|min:6',
            ]);

            // Determine if input is email or username
            $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();

                $user = Auth::user();

                if (is_null($user->email_verified_at)) {
                    // Logout and resend OTP
                    Auth::logout();

                    $otp = rand(100000, 999999);
                    $user->email_otp = $otp;
                    $user->otp_expires_at = now()->addMinutes(10);
                    $user->save();

                    Mail::to($user->email)->send(new EmailVerificationCode($otp));

                    session(['pending_email_verification' => $user->email]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Your email is not verified. A new verification code has been sent.',
                        'redirect' => route('verify.email.show')
                    ], 403);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful.'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid login credentials.'
            ], 401);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Login error', [
                'message' => $e->getMessage(),
                'input' => $request->except('password'),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.'
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showVerifyEmailForm()
    {
        if (!session('pending_email_verification')) {
            return redirect()->route('show.register')->with('error', 'No email verification in progress.');
        }
        return view('auth.verify_email', ['title' => 'verify email']);
    }

    public function verifyEmailCode(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('pending_email_verification');

        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 419);
        }

        $user = User::where('email', $email)->first();

        if (!$user || $user->email_otp != $request->otp) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.'], 422);
        }

        if ($user->otp_expires_at && now()->gt($user->otp_expires_at)) {
            return response()->json(['success' => false, 'message' => 'OTP has expired. Please request a new one.'], 410);
        }

        $user->email_verified_at = now();
        $user->email_otp = null;
        $user->otp_expires_at = null;
        $user->save();

        session()->forget('pending_email_verification');

        Auth::login($user); // Auto-login
        Mail::to($user->email)->send(new UserRegistered($user));

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully!',
            'redirect' => route('dashboard')
        ]);
    }

    public function resendEmailOtp(Request $request)
    {
        $email = session('pending_email_verification');

        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 419);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        $otp = rand(100000, 999999);
        $user->email_otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::to($email)->send(new EmailVerificationCode($otp));

        return response()->json(['success' => true, 'message' => 'OTP resent successfully.']);
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgot_password', ['title' => 'forgot password']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'status' => 'success',
                'message' => __($status)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __($status)
        ], 422);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
            'title'=>'reset password'
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully.']);
        }

        return response()->json([
            'message' => __($status)
        ], 422);
    }
}
