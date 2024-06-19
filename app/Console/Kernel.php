<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Định nghĩa lịch trình chạy các lệnh của ứng dụng.
     */
    protected function schedule(Schedule $schedule)
    {
        // Lên lịch chạy tự động.
        // $schedule->command('tên_lệnh:của_bạn')->hourly();
    }

    /**
     * Đăng ký các lệnh cho ứng dụng.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands'); // Tự động tải các lệnh từ thư mục Commands

        require base_path('routes/console.php'); // Tải các lệnh bổ sung từ file console.php
    }
}
