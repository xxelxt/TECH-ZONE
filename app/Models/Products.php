<?php

namespace App\Models; // Khai báo namespace cho App\Models

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import trait HasFactory
use Illuminate\Database\Eloquent\Model; // Import class Model
use Illuminate\Support\Facades\Auth; // Import Facade Auth

class Products extends Model // Khai báo lớp Products kế thừa từ lớp Model
{
    use HasFactory; // Sử dụng trait HasFactory cho model này

    protected $fillable = [ // Định nghĩa các thuộc tính có thể gán mass-assignment
        'name', // Tên của sản phẩm
        'categories_id', // ID của danh mục mà sản phẩm thuộc về
        'users_id', // ID của người dùng tạo sản phẩm
        'brands_id', // ID của thương hiệu mà sản phẩm thuộc về
        'sub_id', // ID của danh mục con mà sản phẩm thuộc về
        'size', // Kích thước của sản phẩm
        'price', // Giá của sản phẩm
        'price_new', // Giá mới của sản phẩm (nếu có)
        'quantity', // Số lượng tồn kho của sản phẩm
        'image', // Đường dẫn đến hình ảnh chính của sản phẩm
        'link', // Liên kết đến sản phẩm trên trang web
        'content', // Nội dung mô tả sản phẩm
        'featured_product', // Sản phẩm nổi bật
        'active' // Trạng thái hoạt động của sản phẩm
    ];

    public function categories() // Định nghĩa phương thức quan hệ với model Categories
    {
        return $this->belongsTo(Categories::class,'categories_id','id'); // Sản phẩm thuộc về một danh mục
    }

    public function users() // Định nghĩa phương thức quan hệ với model User
    {
        return $this->belongsTo(User::class,'users_id','id'); // Sản phẩm được tạo bởi một người dùng
    }

    public function brands() // Định nghĩa phương thức quan hệ với model Brands
    {
        return $this->belongsTo(Brands::class,'brands_id','id'); // Sản phẩm thuộc về một thương hiệu
    }

    public function subcategories() // Định nghĩa phương thức quan hệ với model Subcategories
    {
        return $this->belongsTo(Subcategories::class, 'sub_id', 'id'); // Sản phẩm thuộc về một danh mục con
    }

    public function Imagelibrary() // Định nghĩa phương thức quan hệ với model ImageLibrary
    {
        return $this->hasMany(ImageLibrary::class,'products_id','id'); // Sản phẩm có nhiều hình ảnh
    }

    public function wishlist() // Định nghĩa phương thức quan hệ với model Wishlist
    {
        $uid = Auth::user()['id']; // Lấy ID của người dùng hiện tại
        return $this->belongsTo(Wishlist::class,'id','products_id')->where('users_id',$uid); // Sản phẩm thuộc danh sách yêu thích của người dùng hiện tại
    }
}
