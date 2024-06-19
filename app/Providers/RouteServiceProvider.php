<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// Cấu hình, quản lý các routes và các dịch vụ khác.
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Đường dẫn đến route "home" cho ứng dụng
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot()
    {
        $this->configureRateLimiting(); // Cấu hình giới hạn tốc độ truy cập

        $this->routes(function () { // Định nghĩa các tuyến đường của ứng dụng
            Route::middleware('api') // Middleware 'api'
                ->prefix('api') // Tiền tố 'api'
                ->group(base_path('routes/api.php')); // Nhóm các tuyến đường từ tệp api.php

            Route::middleware('web') // Middleware 'web'
                ->group(base_path('routes/web.php')); // Nhóm các tuyến đường từ tệp web.php
        });
    }

    /**
     * Cấu hình giới hạn tốc độ truy cập.
     */
    protected function configureRateLimiting()
    {
        // Đặt giới hạn tốc độ truy cập cho 'api' là 60 lượt truy cập mỗi phút
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
