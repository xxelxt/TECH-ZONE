<?php

namespace App\Providers; // Khai báo namespace cho App\Providers

use Illuminate\Support\Facades\Broadcast; // Import Broadcast facade
use Illuminate\Support\ServiceProvider; // Import ServiceProvider class

class BroadcastServiceProvider extends ServiceProvider // Khai báo lớp BroadcastServiceProvider kế thừa từ lớp ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() // Phương thức để khởi động các dịch vụ của ứng dụng
    {
        Broadcast::routes(); // Đăng ký các tuyến đường liên quan đến Broadcast

        require base_path('routes/channels.php'); // Đưa vào các tuyến đường của các kênh Broadcast
    }
}

