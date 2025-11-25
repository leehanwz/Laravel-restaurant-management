<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị trang login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Xử lý login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Kiểm tra status
        if ($user->status !== 'active') {
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'Tài khoản bị khóa.']);
        }

        // Redirect theo role
        switch ($user->role) {
            case 1: // Admin
                return redirect()->intended(route('admin.dashboard'));
            case 2: // Thu ngân
                return redirect()->intended(route('cashier.dashboard'));
            case 3: // Bếp
                return redirect()->intended(route('kitchen.dashboard'));
            case 4: // Bàn
                return redirect()->intended(route('table.dashboard'));
            case 5: // Khách
                return redirect()->intended(route('home'));
            default:
                Auth::logout();
                return redirect('/')->withErrors(['email' => 'Role không hợp lệ.']);
        }
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
