<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // 1. Chưa login -> Đá về login
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. [QUAN TRỌNG] Nếu là Admin (Role 1) -> Cho qua luôn, không cần check gì nữa
        // Logic này giúp Admin vào được cả trang Bếp, trang Thu ngân...
        if ($user->role == 1) {
            return $next($request);
        }

        // 3. Nếu không phải Admin, lúc này mới check xem có đúng role được phép không
        // Lưu ý: Middleware truyền tham số vào thường là String, nên cẩn thận khi so sánh
        if (!in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
