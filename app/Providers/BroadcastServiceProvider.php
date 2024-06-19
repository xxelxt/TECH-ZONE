<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Khởi động các dịch vụ broadcast của ứng dụng.
     */
    public function boot()
    {
        Broadcast::routes(); // Đăng ký các tuyến đường mặc định cho Broadcast

        // 'channels.php' chứa các định nghĩa cho các kênh broadcast riêng tư (yêu cầu xác thực người dùng).
        require base_path('routes/channels.php');
    }
}
