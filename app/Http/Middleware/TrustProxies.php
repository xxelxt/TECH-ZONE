<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

// Middleware này được sử dụng để đánh dấu các proxy mà ứng dụng của bạn tin cậy. 
// Các proxy được liệt kê trong biến $proxies sẽ được xem xét khi xác định địa chỉ IP của client. 
// Điều này hữu ích khi ứng dụng của bạn chạy trong một môi trường proxy 


class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =

    // HEADER_X_FORWARDED_FOR: Được sử dụng để xác định địa chỉ IP của client ban đầu khi thông qua proxy. Nó cho biết địa chỉ IP của client đã kết nối đến proxy.
        Request::HEADER_X_FORWARDED_FOR |
    // HEADER_X_FORWARDED_HOST: Xác định tên miền hoặc địa chỉ IP của máy chủ mà client ban đầu đã gửi yêu cầu đến trước khi đi qua proxy.

        Request::HEADER_X_FORWARDED_HOST |
    // HEADER_X_FORWARDED_PORT: Được sử dụng để chỉ định cổng của máy chủ mà client ban đầu đã gửi yêu cầu đến trước khi đi qua proxy.

        Request::HEADER_X_FORWARDED_PORT |

    // HEADER_X_FORWARDED_PROTO: Xác định giao thức của yêu cầu ban đầu của client trước khi đi qua proxy, chẳng hạn như http hoặc https.
        Request::HEADER_X_FORWARDED_PROTO |

    // HEADER_X_FORWARDED_AWS_ELB: Sử dụng trong môi trường AWS (Amazon Web Services) Elastic Load Balancer (ELB), xác định rằng yêu cầu đã đi qua một ELB.
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
// HEADER_X_FORWARDED_FOR: Được sử dụng để xác định địa chỉ IP của client ban đầu khi thông qua proxy. Nó cho biết địa chỉ IP của client đã kết nối đến proxy.
// HEADER_X_FORWARDED_HOST: Xác định tên miền hoặc địa chỉ IP của máy chủ mà client ban đầu đã gửi yêu cầu đến trước khi đi qua proxy.
// HEADER_X_FORWARDED_PORT: Được sử dụng để chỉ định cổng của máy chủ mà client ban đầu đã gửi yêu cầu đến trước khi đi qua proxy.
// HEADER_X_FORWARDED_PROTO: Xác định giao thức của yêu cầu ban đầu của client trước khi đi qua proxy, chẳng hạn như http hoặc https.
// HEADER_X_FORWARDED_AWS_ELB: Sử dụng trong môi trường AWS (Amazon Web Services) Elastic Load Balancer (ELB), xác định rằng yêu cầu đã đi qua một ELB.