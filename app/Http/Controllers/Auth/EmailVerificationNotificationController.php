<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Gửi email xác thực nếu chưa xác thực.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Nếu đã xác thực rồi thì redirect về dashboard theo role
        if ($user->hasVerifiedEmail()) {
            switch ($user->role) {
                case 1: // Admin
                    return redirect()->route('admin.dashboard');
                case 2: // Thu ngân
                    return redirect()->route('cashier.dashboard');
                case 3: // Bếp
                    return redirect()->route('kitchen.dashboard');
                case 4: // Quản lý bàn
                    return redirect()->route('table.dashboard');
                case 5: // Khách
                    return redirect()->intended(route('login'));
                default:
                    return redirect('/'); // fallback
            }
        }

        // Gửi link xác thực
        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
