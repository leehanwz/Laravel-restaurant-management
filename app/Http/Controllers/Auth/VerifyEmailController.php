<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Xác thực email của user và redirect theo role
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        // Login user (nếu chưa)
        if (!Auth::check()) {
            Auth::login($user);
        }

        // Redirect theo role
        switch ($user->role) {
            case 1:
                return redirect()->route('admin.dashboard')->with('verified', 1);
            case 2:
                return redirect()->route('cashier.dashboard')->with('verified', 1);
            case 3:
                return redirect()->route('kitchen.dashboard')->with('verified', 1);
            case 4:
                return redirect()->route('table.dashboard')->with('verified', 1);
            case 5:
                return redirect()->route('home')->with('verified', true);
            default:
                Auth::logout();
                return redirect('/')->withErrors(['email' => 'Role không hợp lệ.']);
        }
    }
}
