<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategories;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Discounts;
use App\Models\User;
use App\Models\Products;
use App\Models\Banners;

class AjaxController extends Controller
{
    // Phương thức để lấy các tiểu mục dựa trên ID danh mục
    public function getSub($cat_id)
    {
        // Lấy tất cả các tiểu mục có cat_id bằng với giá trị được truyền vào
        $subcategories = Subcategories::where('cat_id', $cat_id)->get();
        // Lặp qua danh sách các tiểu mục và in ra các thẻ <option>
        foreach ($subcategories as $value) {
            // In ra thẻ <option> với giá trị và tên của tiểu mục
            echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
    }

    // Phương thức để cập nhật trạng thái hoạt động của danh mục
    public function Categories(Request $request)
    {
        // Tìm danh mục dựa trên cate_id từ yêu cầu
        $categories = Categories::find($request->cate_id);
        // Cập nhật trường active với giá trị mới từ request
        $categories->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $categories->save();
    }

    // Phương thức để cập nhật trạng thái hoạt động của tiểu mục
    public function Subcategories(Request $request)
    {
        // Tìm tiểu mục dựa trên sub_id từ yêu cầu
        $subcategories = Subcategories::find($request->sub_id);
        // Cập nhật trường active với giá trị mới từ request
        $subcategories->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $subcategories->save();
    }

    // Phương thức để cập nhật trạng thái hoạt động của thương hiệu
    public function Brands(Request $request)
    {
        // Tìm thương hiệu dựa trên brand_id từ yêu cầu
        $Brands = Brands::find($request->brand_id);
        // Cập nhật trường active với giá trị mới từ request
        $Brands->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $Brands->save();
    }

    // Phương thức để cập nhật trạng thái hoạt động của nhân viên
    public function Staff(Request $request)
    {
        // Tìm nhân viên dựa trên staff_id từ yêu cầu
        $Staff = User::find($request->staff_id);
        // Kiểm tra xem nhân viên có vai trò admin hay không
        if ($Staff->hasRole('admin')) {
            // Nếu có, không thực hiện thay đổi và trả về phản hồi rỗng
            return response();
        } else {
            // Nếu không phải admin, cập nhật trạng thái hoạt động
            $Staff->active = $request->active;
            // Lưu thay đổi vào cơ sở dữ liệu
            $Staff->save();
        }
    }

    // Phương thức để cập nhật trạng thái hoạt động của giảm giá
    public function Discounts(Request $request)
    {
        // Tìm giảm giá dựa trên dis_id từ yêu cầu
        $Discounts = Discounts::find($request->dis_id);
        // Cập nhật trường active với giá trị mới từ request
        $Discounts->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $Discounts->save();
    }

    // Phương thức để cập nhật trạng thái hoạt động của sản phẩm
    public function Products(Request $request)
    {
        // Tìm sản phẩm dựa trên product_id từ yêu cầu
        $Products = Products::find($request->product_id);
        // Cập nhật trường active với giá trị mới từ request
        $Products->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $Products->save();
    }

    // Phương thức để cập nhật trạng thái "sản phẩm nổi bật" của sản phẩm
    public function Featured_Products(Request $request)
    {
        // Tìm sản phẩm dựa trên featured_id từ yêu cầu
        $Products = Products::find($request->featured_id);
        // Cập nhật trường featured_product với giá trị mới từ request
        $Products->featured_product = $request->featured_product;
        // Lưu thay đổi vào cơ sở dữ liệu
        $Products->save();
    }

    // Phương thức để cập nhật trạng thái hoạt động của người dùng
    public function Users(Request $request)
    {
        // Tìm người dùng dựa trên user_id từ yêu cầu
        $User = User::find($request->user_id);
        // Cập nhật trường active với giá trị mới từ request
        $User->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $User->save();
    }

    // Phương thức để cập nhật trạng thái hoạt động của banner
    public function Banners(Request $request)
    {
        // Tìm banner dựa trên ban_id từ yêu cầu
        $Banners = Banners::find($request->ban_id);
        // Cập nhật trường active với giá trị mới từ request
        $Banners->active = $request->active;
        // Lưu thay đổi vào cơ sở dữ liệu
        $Banners->save();
    }
}
