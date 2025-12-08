<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            switch ($user->role) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('cashier.dashboard');
                case 3:
                    return redirect()->route('kitchen.dashboard');
                case 4:
                    return redirect()->route('table.dashboard');
                case 5:
                    return redirect()->intended(route('Shop.home'));
                default:
                    return redirect('/');
            }
        }

        return view('auth.verify-email');
    }
}
