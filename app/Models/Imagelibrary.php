<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagelibrary extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'image_library'
    ];

    public function products()
    {
        // Trả về mối quan hệ 'belongsTo' giữa model hiện tại và model 'Products'
        return $this->belongsTo(Products::class, 'products_id', 'id');
        
        /**
         * Giải thích:
         * Products::class: Tên của model mà mối quan hệ này thuộc về (Products)
         * 'products_id': Tên của cột khoá ngoại trong bảng hiện tại, liên kết với bảng 'products'
         * 'id': Tên của cột khoá chính trong bảng 'products'
         */
    }
}