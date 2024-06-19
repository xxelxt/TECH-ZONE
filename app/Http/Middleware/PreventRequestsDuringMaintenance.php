<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Các URI có thể truy cập khi hệ thống đang bảo trì.
     */
    protected $except = [];
}
