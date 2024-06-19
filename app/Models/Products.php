<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'categories_id',
        'users_id',
        'brands_id',
        'sub_id',
        'size',
        'price',
        'price_new',
        'quantity',
        'image',
        'link',
        'content',
        'featured_product',
        'active'
    ];

    public function categories() // Quan hệ với model Categories
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'id'); // Sản phẩm thuộc về một danh mục
    }

    public function users() // Quan hệ với model User
    {
        return $this->belongsTo(User::class, 'users_id', 'id'); // Sản phẩm được tạo bởi một người dùng
    }

    public function brands() // Quan hệ với model Brands
    {
        return $this->belongsTo(Brands::class, 'brands_id', 'id'); // Sản phẩm thuộc về một thương hiệu
    }

    public function subcategories() // Quan hệ với model Subcategories
    {
        return $this->belongsTo(Subcategories::class, 'sub_id', 'id'); // Sản phẩm thuộc về một danh mục con
    }

    public function Imagelibrary() // Quan hệ với model ImageLibrary
    {
        return $this->hasMany(ImageLibrary::class, 'products_id', 'id'); // Sản phẩm có nhiều hình ảnh
    }

    public function wishlist() // Quan hệ với model Wishlist
    {
        $uid = Auth::user()['id']; // Lấy ID của người dùng hiện tại
        return $this->belongsTo(Wishlist::class, 'id', 'products_id')->where('users_id', $uid); // Sản phẩm thuộc danh sách yêu thích của người dùng hiện tại
    }
}
