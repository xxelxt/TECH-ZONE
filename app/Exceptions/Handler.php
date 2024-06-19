<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     * Danh sách các loại ngoại lệ với mức độ log tương ứng của chúng.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        // Định nghĩa các ngoại lệ với mức độ log tùy chỉnh (nếu cần).
    ];

    /**
     * A list of the exception types that are not reported.
     * Danh sách các loại ngoại lệ không được báo cáo.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // Định nghĩa các ngoại lệ mà bạn không muốn báo cáo (log).
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     * Danh sách các đầu vào không bao giờ được lưu trữ trong session khi xảy ra ngoại lệ xác thực.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password', // Không lưu trữ 'current_password' vào session
        'password',         // Không lưu trữ 'password' vào session
        'password_confirmation', // Không lưu trữ 'password_confirmation' vào session
    ];

    /**
     * Register the exception handling callbacks for the application.
     * Đăng ký các callback xử lý ngoại lệ cho ứng dụng.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Định nghĩa các callback để xử lý các ngoại lệ có thể báo cáo.
        });
    }
}
