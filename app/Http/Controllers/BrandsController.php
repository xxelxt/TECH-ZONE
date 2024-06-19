<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandsController extends Controller
{
    // Phương thức để hiển thị danh sách các thương hiệu
    public function list()
    {
        // Lấy danh sách thương hiệu theo thứ tự giảm dần của id và phân trang 10 phần tử mỗi trang
        $brands = Brands::orderBy('id', 'DESC')->paginate(10);
        // Trả về view 'admin.brands.list' với dữ liệu thương hiệu
        return view('admin.brands.list', ['brands' => $brands]);
    }

    // Phương thức để kích hoạt thương hiệu
    public function Active($id)
    {
        // Cập nhật trạng thái active của thương hiệu thành 1
        Brands::where('id', $id)->update(['active' => 1]);
        // Chuyển hướng về danh sách thương hiệu với thông báo thành công
        return redirect('admin/brands/list')->with('thongbao', 'Update thành công');
    }

    // Phương thức để tắt kích hoạt thương hiệu
    public function Block($id)
    {
        // Cập nhật trạng thái active của thương hiệu thành 0
        Brands::where('id', $id)->update(['active' => 0]);
        // Chuyển hướng về danh sách thương hiệu với thông báo thành công
        return redirect('admin/brands/list')->with('thongbao', 'Update thành công');
    }

    // Phương thức để hiển thị trang chỉnh sửa thương hiệu
    public function getEdit($id)
    {
        // Tìm thương hiệu theo id và trả về view chỉnh sửa thương hiệu
        $brands = Brands::find($id);
        return view('admin.brands.edit', ['brands' => $brands]);
    }

    // Phương thức để hiển thị trang tạo mới thương hiệu
    public function getCreate()
    {
        // Trả về view 'admin.brands.create'
        return view('admin.brands.create');
    }

    // Phương thức để xử lý yêu cầu tạo mới thương hiệu
    public function postCreate(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào từ request
        $request->validate([
            'name' => 'required|unique:brands'
        ], [
            'name.required' => "Vui lòng nhập tên thương hiệu",
            'name.unique' => 'Tên thương hiệu này đã tồn tại'
        ]);
        // Kiểm tra nếu có file hình ảnh được upload
        if ($request->hasFile('Image')) {
            $file =  $request->file('Image');
            $format = $file->getClientOriginalExtension();
            // Kiểm tra định dạng file có hợp lệ không
            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('admin/brands/create')->with('thongbao', 'Không hỗ trợ ' . $format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;
            // Đảm bảo tên file là duy nhất
            while (file_exists("user_asset/images/brands" . $img)) {
                $img = Str::random(4) . '-' . $name;
            }
            // Di chuyển file đến thư mục đích
            $file->move('user_asset/images/brands', $img);
            // Gán tên file vào request
            $request['image'] = $img;
        }

        // Tạo mới thương hiệu với dữ liệu từ request
        Brands::create($request->all());

        // Chuyển hướng về danh sách thương hiệu với thông báo thành công
        return redirect('admin/brands/list')->with('thongbao', 'Thêm thành công');
    }

    // Phương thức để xử lý yêu cầu chỉnh sửa thương hiệu
    public function postEdit(Request $request, $id)
    {
        // Tìm thương hiệu theo id
        $brands = Brands::find($id);

        // Kiểm tra nếu có file hình ảnh mới được upload
        if ($request->hasFile('Image')) {
            $file =  $request->file('Image');
            $format = $file->getClientOriginalExtension();
            // Kiểm tra định dạng file có hợp lệ không
            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('admin/brands/create')->with('thongbao', 'Không hỗ trợ ' . $format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;
            // Đảm bảo tên file là duy nhất
            while (file_exists("user_asset/images/brands/" . $img)) {
                $img = Str::random(4) . '-' . $name;
            }
            // Di chuyển file đến thư mục đích
            $file->move('user_asset/images/brands/', $img);
            // Xóa file hình ảnh cũ nếu có
            if ($brands->image != '') {
                unlink('user_asset/images/brands/' . $brands->image);
            }
            // Gán tên file mới vào request
            $request['image'] = $img;
        }

        // Cập nhật thương hiệu với dữ liệu từ request
        $brands->update($request->all());

        // Chuyển hướng về danh sách thương hiệu với thông báo thành công
        return redirect('admin/brands/list')->with('thongbao', 'Sửa thành công');
    }

    // Phương thức để xóa thương hiệu và trả về phản hồi JSON
    public function delete_brands($id)
    {
        // Đếm số lượng sản phẩm thuộc thương hiệu này
        $check = count(Products::where('brands_id', $id)->get());
        if ($check == 0) {
            // Tìm thương hiệu theo id
            $image = Brands::find($id);
            // Kiểm tra nếu file hình ảnh tồn tại thì xóa nó
            if (File::exists('user_asset/images/brands/' . $image->image)) {
                File::delete('user_asset/images/brands/' . $image->image);
            }
            // Xóa thương hiệu khỏi cơ sở dữ liệu
            $image->delete();
            // Trả về phản hồi JSON thông báo thành công
            return response()->json(['success' => 'Delete Successfully']);
        } else {
            // Trả về phản hồi JSON thông báo lỗi
            return response()->json(['error' => "Can't delete because Brand exist Product"]);
        }
    }

    // Phương thức để xóa nhiều thương hiệu và trả về phản hồi JSON
    public function deleteall_brands(Request $request)
    {
        // Lấy danh sách id của thương hiệu cần xóa từ request
        $ids = $request->ids;
        // Đếm số lượng sản phẩm thuộc các thương hiệu này
        $check = count(Products::where('brands_id', $ids)->get());
        // Lấy tất cả thương hiệu
        $brands = Brands::all();
        if ($check == 0) {
            // Lặp qua danh sách thương hiệu để xóa file hình ảnh
            foreach ($brands as $img) {
                if (File::exists('user_asset/images/brands/' . $img->image)) {
                    File::delete('user_asset/images/brands/' . $img->image);
                }
            }
            // Xóa các thương hiệu khỏi cơ sở dữ liệu
            Brands::whereIn('id', explode(',', $ids))->delete();
            // Trả về phản hồi JSON thông báo thành công
            return response()->json(['success' => "Brands deleted successfully."]);
        } else {
            // Trả về phản hồi JSON thông báo lỗi
            return response()->json(['error' => "Can't delete because Brand exist Product"]);
        }
    }
}

