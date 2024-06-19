<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Danh sách các loại ngoại lệ và mức độ log tương ứng.
     */
    protected $levels = [];

    /**
     * Danh sách các loại ngoại lệ không được báo cáo (ghi log).
     */
    protected $dontReport = [];

    /**
     * Danh sách các trường nhập liệu không được lưu vào session khi có lỗi validation.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Đăng ký các hàm xử lý ngoại lệ cho ứng dụng.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }
}
