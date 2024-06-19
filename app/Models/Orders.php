<?php

namespace App\Models; // Khai báo namespace cho namespace App\Models

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import trait HasFactory
use Illuminate\Database\Eloquent\Model; // Import class Model

class Orders extends Model // Khai báo lớp Orders kế thừa từ lớp Model
{
    use HasFactory; // Sử dụng trait HasFactory cho model này

    protected $fillable = [ // Định nghĩa các thuộc tính có thể gán mass-assignment
        'users_id', // ID của người dùng liên kết với đơn hàng
        'lastname', // Họ của khách hàng
        'firstname', // Tên của khách hàng
        'address', // Địa chỉ của khách hàng
        'district', // Quận của địa chỉ của khách hàng
        'city', // Thành phố của địa chỉ của khách hàng
        'phone', // Số điện thoại của khách hàng
        'email', // Địa chỉ email của khách hàng
        'content', // Nội dung của đơn hàng
        'total', // Tổng số tiền của đơn hàng
        'status', // Trạng thái của đơn hàng
        'payment_status' // Trạng thái thanh toán của đơn hàng
    ];

    public function users() // Định nghĩa phương thức quan hệ với model User
    {
        return $this->belongsTo(User::class,'users_id','id'); // Đơn hàng thuộc về một người dùng
    }

    public function orders_details() // Định nghĩa phương thức quan hệ với model Orders_Detail
    {
        return $this->hasMany(Orders_Detail::class,'id','orders_id'); // Đơn hàng có nhiều chi tiết đơn hàng
    }
}
