<?php

namespace App\Providers; // Khai báo namespace cho App\Providers

use Illuminate\Cache\RateLimiting\Limit; // Import Limit class từ Illuminate\Cache\RateLimiting
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider; // Import class RouteServiceProvider từ Illuminate\Foundation\Support\Providers
use Illuminate\Http\Request; // Import class Request từ Illuminate\Http
use Illuminate\Support\Facades\RateLimiter; // Import RateLimiter facade từ Illuminate\Support\Facades
use Illuminate\Support\Facades\Route; // Import Route facade từ Illuminate\Support\Facades

// Tệp RouteServiceProvider đóng vai trò quan trọng trong việc cấu hình và quản lý các tuyến đường (routes)
//  cũng như các dịch vụ khác cho ứng dụng Laravel của bạn.
class RouteServiceProvider extends ServiceProvider // Khai báo lớp RouteServiceProvider kế thừa từ lớp ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home'; // Đường dẫn đến route "home" cho ứng dụng của bạn

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot() // Phương thức để khởi động các dịch vụ của ứng dụng
    {
        $this->configureRateLimiting(); // Gọi phương thức để cấu hình giới hạn tốc độ truy cập

        $this->routes(function () { // Định nghĩa các tuyến đường của ứng dụng
            Route::middleware('api') // Middleware 'api'
                ->prefix('api') // Tiền tố 'api'
                ->group(base_path('routes/api.php')); // Nhóm các tuyến đường từ tệp api.php

            Route::middleware('web') // Middleware 'web'
                ->group(base_path('routes/web.php')); // Nhóm các tuyến đường từ tệp web.php
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting() // Phương thức để cấu hình giới hạn tốc độ truy cập
    {
        RateLimiter::for('api', function (Request $request) { // Đặt giới hạn tốc độ truy cập cho 'api'
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()); // Giới hạn 60 lượt truy cập mỗi phút
        });
    }
}
