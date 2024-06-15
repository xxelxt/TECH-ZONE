<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    /**
     * Xử lý một yêu cầu đến.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có bị cấm không
        if(auth()->check() && (auth()->user()->active == 0)){
            // Nếu người dùng bị cấm, đăng xuất người dùng
            Auth::logout();

            // Hủy bỏ phiên làm việc của người dùng
            $request->session()->invalidate();

            // Tạo lại mã token cho phiên làm việc mới
            $request->session()->regenerateToken();

            // Chuyển hướng người dùng đến trang trước đó và thông báo rằng tài khoản của họ đã bị cấm
            return redirect()->back()->with('canhbao', 'Your account has been banned');
        }
        // Nếu không có vấn đề gì, tiếp tục xử lý yêu cầu tiếp theo
        return $next($request);
    }
}
