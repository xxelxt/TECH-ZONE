<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Lấy đường dẫn người dùng sẽ được chuyển hướng đến khi họ không được xác thực.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('admin/login');
        }
    }
}
