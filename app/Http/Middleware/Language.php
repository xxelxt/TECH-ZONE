<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Xử lý một yêu cầu đến.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem phiên làm việc hiện tại có chứa giá trị ngôn ngữ không
        if(session()->has('locale'))
        {
            // Nếu có, thiết lập ngôn ngữ ứng dụng theo giá trị trong phiên làm việc
            App::setlocale(session()->get('locale'));
        }
        // Tiếp tục xử lý yêu cầu tiếp theo
        return $next($request);
    }
}
