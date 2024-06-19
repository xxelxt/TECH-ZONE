<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

// Xử lý các yêu cầu HTTP khi ứng dụng chạy phía sau một hoặc nhiều proxy server (ví dụ: load balancer, tường lửa, CDN).
class TrustProxies extends Middleware
{
    /**
     * Danh sách các proxy server tin cậy.
     * protected $proxies = ['192.168.1.1', '10.0.0.0/8']; 
     */
    protected $proxies;

    /**
     * Danh sách các tiêu đề (header) HTTP sẽ kiểm tra để xác định thông tin về client ban đầu và proxy.
     * Các tiêu đề này thường được các proxy server thêm vào yêu cầu.
     */
    protected $headers =
        // Xác định địa chỉ IP thật của client (người dùng).
        Request::HEADER_X_FORWARDED_FOR | 

        // Xác định tên miền hoặc địa chỉ IP của máy chủ mà client đã gửi yêu cầu đến trước khi đi qua proxy.
        Request::HEADER_X_FORWARDED_HOST | 

        // Xác định cổng của máy chủ mà client đã gửi yêu cầu đến trước khi đi qua proxy.
        Request::HEADER_X_FORWARDED_PORT | 

        // Xác định giao thức (HTTP hoặc HTTPS) của yêu cầu gốc từ client.
        Request::HEADER_X_FORWARDED_PROTO | 

        // Xác định rằng yêu cầu đã đi qua một Elastic Load Balancer (ELB) của Amazon Web Services.
        Request::HEADER_X_FORWARDED_AWS_ELB; 
}
