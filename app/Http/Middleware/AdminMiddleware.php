<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    /**
     * Xử lý một yêu cầu đến.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, \Closure $next){
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if(!empty(auth()->user())){
            // Nếu đã đăng nhập, thiết lập team_id từ giá trị session được đặt khi đăng nhập
            setPermissionsTeamId(session('team_id'));
        }
        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập của quản trị viên
        else
        {
            return redirect('admin/login');
        }
        return $next($request);
    }
}

