<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Các URI mà nên có thể truy cập khi chế độ bảo trì được kích hoạt.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}