<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function checkCartCookie()
    {
        if (Cookie::has('cart')) {
            $cartContent = Cookie::get('cart');

            echo "Dữ liệu của cookie 'cart': <pre>";
            var_dump($cartContent);
            echo "</pre>";
        } else {
            echo "Cookie 'cart' không tồn tại.";
        }
    }
}
