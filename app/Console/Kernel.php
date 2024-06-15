<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * Định nghĩa lịch trình cho các lệnh của ứng dụng.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // Định nghĩa một lệnh 'inspire' sẽ chạy mỗi giờ.
        // Dòng này bị comment nên không thực hiện lệnh nào.
    }

    /**
     * Register the commands for the application.
     * Đăng ký các lệnh cho ứng dụng.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        // Tải tất cả các lệnh được định nghĩa trong thư mục 'app/Console/Commands'.

        require base_path('routes/console.php');
        // Yêu cầu (require) file 'routes/console.php', nơi bạn có thể định nghĩa các lệnh bổ sung.
    }
}

