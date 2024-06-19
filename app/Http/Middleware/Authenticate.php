<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Lấy đường dẫn người dùng sẽ được chuyển hướng đến khi họ không được xác thực.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Nếu yêu cầu không mong đợi JSON (ví dụ: trang web), chuyển hướng người dùng đến trang đăng nhập của quản trị viên
        if (! $request->expectsJson()) {
            return route('admin/login');
        }
    }
}

