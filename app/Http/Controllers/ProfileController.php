<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Hiển thị form profile
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Cập nhật thông tin profile
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Chỉ cập nhật các trường được phép chỉnh
        $user->fill($request->validated());

        // Nếu email thay đổi → reset email verified
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Lưu lại
        $user->save();

        // Redirect về dashboard theo role (tuỳ chọn)
        switch ($user->role) {
            case 1:
                return redirect()->route('admin.dashboard')->with('status', 'profile-updated');
            case 2:
                return redirect()->route('cashier.dashboard')->with('status', 'profile-updated');
            case 3:
                return redirect()->route('kitchen.dashboard')->with('status', 'profile-updated');
            case 4:
                return redirect()->route('table.dashboard')->with('status', 'profile-updated');
            case 5:
                return redirect()->route('customer.dashboard')->with('status', 'profile-updated');
            default:
                return redirect('/')->with('status', 'profile-updated');
        }
    }

    /**
     * Xóa tài khoản
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
