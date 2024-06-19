<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Tên của các cookie không nên được mã hóa.
     */
    protected $except = [];
}
