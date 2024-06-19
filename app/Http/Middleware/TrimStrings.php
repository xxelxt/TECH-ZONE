<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}

// Middleware này được sử dụng để cắt gọn các chuỗi dữ liệu được gửi trong yêu cầu HTTP trước khi chúng được xử lý bởi ứng dụng.
// Mục đích của việc cắt gọn là loại bỏ các khoảng trắng không cần thiết từ đầu và cuối của chuỗi.
// Tuy nhiên, các thuộc tính được liệt kê trong mảng $except sẽ không bị cắt gọn. Điều này hữu ích khi làm việc với mật khẩu,
// vì chúng thường được nhập với các khoảng trắng ở đầu và cuối để người dùng có thể nhập dễ dàng hơn.
