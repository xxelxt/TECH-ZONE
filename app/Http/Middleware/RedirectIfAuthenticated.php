<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Xác định các guard được chỉ định, nếu không có thì mặc định là null
        $guards = empty($guards) ? [null] : $guards;

        // Duyệt qua từng guard để kiểm tra xem người dùng đã đăng nhập chưa
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Nếu người dùng đã đăng nhập, chuyển hướng đến trang HOME
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Nếu người dùng chưa đăng nhập, tiếp tục xử lý yêu cầu tiếp theo
        return $next($request);
    }
}
