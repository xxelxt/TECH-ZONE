<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Xử lý một yêu cầu đến.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Xác định các bảo vệ được chỉ định, nếu không có thì mặc định là null
        $guards = empty($guards) ? [null] : $guards;

        // Duyệt qua từng guard để kiểm tra xem người dùng đã đăng nhập chưa
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Nếu người dùng đã đăng nhập, chuyển hướng đến trang HOME được xác định trong RouteServiceProvider
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Nếu người dùng chưa đăng nhập, tiếp tục xử lý yêu cầu tiếp theo
        return $next($request);
    }
}

