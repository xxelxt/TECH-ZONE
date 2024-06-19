<?php

namespace App\Models;
//HasFactory là một trait (khái niệm trong PHP cho phép tái sử dụng các phương thức) cung cấp các phương thức để giúp bạn dễ dàng tạo ra các "factory" 
// (các lớp giả lập dữ liệu cho việc kiểm thử) cho các model của bạn. 
// Factory giúp tạo ra các bản ghi giả lập trong cơ sở dữ liệu một cách dễ dàng, 
// đặc biệt là trong quá trình phát triển và kiểm thử ứng dụng.
use Illuminate\Database\Eloquent\Factories\HasFactory;


//Model là lớp cơ bản mà tất cả các model trong Laravel phải kế thừa.
//  Nó cung cấp một loạt các phương thức và thuộc tính để tương tác với cơ sở dữ liệu.
//   Bằng cách kế thừa từ Model, bạn có thể thực hiện các hoạt động như 



//                tạo, đọc, cập nhật và xóa dữ liệu 



//từ cơ sở dữ liệu một cách dễ dàng thông qua các phương thức như 

//               create(), find(), update(), delete(), v.v. 

//   Đồng thời, nó cũng cho phép bạn thiết lập các quan hệ giữa các model, 
//   thực hiện các truy vấn phức tạp và thực hiện các tính năng như kiểm tra tồn tại, điều kiện where, sắp xếp, v.v.
use Illuminate\Database\Eloquent\Model;

use App\Models\Subcategories;
class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'active'
    ];
    public function Subcategories()
    {

        // hasMany(Subcategory::class, 'cat_id', 'id') chỉ ra rằng mối quan hệ này là một-nhiều.
        // Subcategory::class là model con mà Category có thể có nhiều.
        // 'cat_id' là tên của cột ngoại khóa trong bảng subcategories liên kết với bảng categories.
        // 'id' là tên của cột chính trong bảng categories.
        return $this->hasMany(Subcategories::class,'cat_id','id');
    }
}
