<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

// Cắt gọn (trim) các chuỗi dữ liệu được gửi trong request trước khi được xử lý bởi ứng dụng
class TrimStrings extends Middleware
{
    /**
     * Các thuộc tính không cần trim.
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
