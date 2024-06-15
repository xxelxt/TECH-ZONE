<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Discounts;

class DiscountsController extends Controller
{
    // Phương thức để hiển thị danh sách các mã giảm giá
    public function list()
    {
        // Lấy danh sách mã giảm giá và sắp xếp theo id giảm dần, sau đó phân trang mỗi trang có tối đa 10 mã giảm giá
        $discounts = Discounts::orderBy('id', 'DESC')->paginate(10);
        // Trả về view 'admin.discounts.list' với biến 'discounts' chứa danh sách các mã giảm giá
        return view('admin.discounts.list', ['discounts' => $discounts]);
    }

    // Phương thức để hiển thị form chỉnh sửa mã giảm giá dựa trên id
    public function getEdit($id)
    {
        // Tìm mã giảm giá dựa trên id
        $discounts = Discounts::find($id);
        // Trả về view 'admin.discounts.edit' với biến 'discounts' chứa thông tin của mã giảm giá
        return view('admin.discounts.edit', ['discounts' => $discounts]);
    }

    // Phương thức để hiển thị form thêm mới mã giảm giá
    public function getCreate()
    {
        // Trả về view 'admin.discounts.create'
        return view('admin.discounts.create');
    }

    // Phương thức để xử lý việc thêm mới mã giảm giá dựa trên dữ liệu được gửi từ form
    public function postCreate(Request $request)
    {
        // Kiểm tra dữ liệu được gửi từ form
        $request->validate([
            'code' => 'required|unique:discounts',
            'discounts' => 'numeric|min:0|max:100'
        ], [
            'code.required' => 'Vui lòng nhập mã giảm giá',
            'code.unique' => 'Mã giảm giá này đã tồn tại',
            'discounts.max' => 'Mã giảm giá tối đa là 100',
            'discounts.min' => 'Mã giảm giá tối thiểu là 0'
        ]);
        
        // Tạo mới một bản ghi mã giảm giá với dữ liệu được gửi từ form
        Discounts::create($request->all());

        // Chuyển hướng về trang danh sách mã giảm giá và thông báo thêm thành công
        return redirect('admin/discounts/list')->with('thongbao', 'Thêm thành công');
    }

    // Phương thức để xử lý việc chỉnh sửa thông tin mã giảm giá dựa trên dữ liệu được gửi từ form
    public function postEdit(Request $request, $id)
    {
        // Tìm mã giảm giá dựa trên id
        $discounts = Discounts::find($id);

        // Kiểm tra dữ liệu được gửi từ form
        $request->validate([
            'code' => 'required',
            'discounts' => 'numeric|min:0|max:100'
        ], [
            'code.required' => 'Vui lòng nhập mã giảm giá',
            'discounts.max' => 'Mã giảm giá tối đa là 100',
            'discounts.min' => 'Mã giảm giá tối thiểu là 0'
        ]);

        // Cập nhật thông tin của mã giảm giá với dữ liệu được gửi từ form
        $discounts->update($request->all());

        // Chuyển hướng về trang danh sách mã giảm giá và thông báo sửa thành công
        return redirect('admin/discounts/list')->with('thongbao', 'Sửa thành công');
    }

    // Phương thức để xóa một mã giảm giá dựa trên id
    public function delete_discounts($id)
    {
        // Xóa mã giảm giá dựa trên id
        Discounts::destroy($id);
        // Trả về thông báo xóa thành công
        return response()->json(['success' => 'Xóa thành công']);
    }

    // Phương thức để xóa nhiều mã giảm giá dựa trên danh sách id được gửi từ form
    public function deleteall_discounts(Request $request)
    {
        // Lấy danh sách id được gửi từ form
        $ids = $request->ids;

        // Xóa nhiều mã giảm giá dựa trên danh sách id
        Discounts::whereIn('id', explode(',', $ids))->delete();

        // Trả về thông báo xóa thành công
        return response()->json(['success' => 'Xóa thành công']);
    }
}
