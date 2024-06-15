<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function checkCartCookie()
    {
        // Kiểm tra xem cookie "cart" có tồn tại không
        if (Cookie::has('cart')) {
            // Lấy nội dung của cookie "cart"
            $cartContent = Cookie::get('cart');

            // In ra dữ liệu của cookie để kiểm tra
            echo "Dữ liệu của cookie 'cart': <pre>";
            var_dump($cartContent);
            echo "</pre>";
        } else {
            echo "Cookie 'cart' không tồn tại.";
        }
    }
}
