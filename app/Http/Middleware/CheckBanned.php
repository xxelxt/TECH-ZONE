<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có bị khoá không
        if(auth()->check() && (auth()->user()->active == 0)){
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->back()->with('canhbao', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ TechZone để biết thêm chi tiết.');
        }

        return $next($request);
    }
}
