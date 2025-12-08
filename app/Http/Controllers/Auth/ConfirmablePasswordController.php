<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Hiển thị form xác nhận mật khẩu
     * Form này dùng trước khi thực hiện các thao tác nhạy cảm
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Xác nhận mật khẩu của user
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Kiểm tra password có đúng không
        if (! Auth::guard('web')->validate([
            'email' => $user->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'), // thông báo lỗi mặc định
            ]);
        }

        // Lưu thời gian xác nhận password vào session (Laravel dùng để check timeout)
        $request->session()->put('auth.password_confirmed_at', time());

        // Redirect theo role, giống AuthenticatedSessionController
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
                return redirect()->intended(route('Shop.home'));
            default:
                Auth::logout();
                return redirect('/')->withErrors(['password' => 'Role không hợp lệ.']);
        }
    }
}
