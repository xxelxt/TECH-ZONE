<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Subcategories;

class CategoriesController extends Controller
{
    // Phương thức để hiển thị danh sách các danh mục
    public function list()
    {
        // Lấy danh sách danh mục theo thứ tự giảm dần của id và phân trang 10 phần tử mỗi trang
        $categories = Categories::orderBy('id', 'DESC')->paginate(10);
        // Trả về view 'admin.categories.list' với dữ liệu danh mục
        return view('admin.categories.list', ['categories' => $categories]);
    }

    // Phương thức để hiển thị trang chỉnh sửa danh mục
    public function getEdit($id)
    {
        // Tìm danh mục theo id và trả về view chỉnh sửa danh mục
        $categories = Categories::find($id);
        return view('admin.categories.edit', ['categories' => $categories]);
    }

    // Phương thức để hiển thị trang tạo mới danh mục
    public function getCreate()
    {
        // Trả về view 'admin.categories.create'
        return view('admin.categories.create');
    }

    // Phương thức để xử lý yêu cầu tạo mới danh mục
    public function postCreate(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào từ request
        $request->validate([
            'name' => 'required|unique:categories'
        ], [
            'name.required' => "Vui lòng nhập tên danh mục",
            'name.unique' => 'Tên danh mục này đã tồn tại'
        ]);

        // Tạo mới danh mục với dữ liệu từ request
        Categories::create($request->all());

        // Chuyển hướng về danh sách danh mục với thông báo thành công
        return redirect('admin/categories/list')->with('thongbao', 'Thêm thành công');
    }

    // Phương thức để xử lý yêu cầu chỉnh sửa danh mục
    public function postEdit(Request $request, $id)
    {
        // Tìm danh mục theo id
        $categories = Categories::find($id);

        // Kiểm tra dữ liệu nhập vào từ request
        $request->validate([
            'name' => 'required|unique:categories'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục này đã tồn tại'
        ]);

        // Cập nhật danh mục với dữ liệu từ request
        $categories->update($request->all());

        // Chuyển hướng về danh sách danh mục với thông báo thành công
        return redirect('admin/categories/list')->with('thongbao', 'Sửa thành công');
    }

    // Phương thức để xóa danh mục và trả về phản hồi JSON
    public function delete_categories($id)
    {
        // Đếm số lượng danh mục con thuộc danh mục này
        $check = count(Subcategories::where('cat_id', $id)->get());
        if ($check == 0) {
            // Xóa danh mục theo id
            Categories::destroy($id);
            // Trả về phản hồi JSON thông báo thành công
            return response()->json(['success' => 'Delete Successfully']);
        } else {
            // Trả về phản hồi JSON thông báo lỗi
            return response()->json(['error' => "Can't delete because Category exist Subcategory"]);
        }
    }

    // Phương thức để xóa nhiều danh mục và trả về phản hồi JSON
    public function deleteall_categories(Request $request)
    {
        // Lấy danh sách id của danh mục cần xóa từ request
        $ids = $request->ids;
        // Đếm số lượng danh mục con thuộc các danh mục này
        $check = count(Subcategories::where('cat_id', $ids)->get());
        if ($check != 0) {
            // Trả về phản hồi JSON
            return response()->json(['error' => "Can't delete because Category exist Subcategory"]);
            
        } 
        else 
        {
            Categories::whereIn('id', explode(',', $ids))->delete();
            return response()->json(['success' => "Categories deleted successfully."]);
        }
    }
}

