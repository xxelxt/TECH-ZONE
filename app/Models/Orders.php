<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'lastname',
        'firstname',
        'address',
        'district',
        'city',
        'phone',
        'email',
        'content',
        'total',
        'status',
        'payment_status'
    ];

    public function users() // Quan hệ với model User
    {
        return $this->belongsTo(User::class, 'users_id', 'id'); // Đơn hàng thuộc về một người dùng
    }

    public function orders_details() // Quan hệ với model Orders_Detail
    {
        return $this->hasMany(Orders_Detail::class, 'id', 'orders_id'); // Đơn hàng có nhiều chi tiết đơn hàng
    }
}
