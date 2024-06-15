<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BannersController extends Controller
{
    // Phương thức để liệt kê tất cả các banners
    public function list()
    {
        // Lấy tất cả banners từ cơ sở dữ liệu
        $banners = Banners::all();
        // Trả về view 'admin.banners.list' với dữ liệu banners
        return view('admin.banners.list', ['banners' => $banners]);
    }

    // Phương thức để hiển thị trang tạo mới banner
    public function getCreate()
    {
        // Trả về view 'admin.banners.create'
        return view('admin.banners.create');
    }

    // Phương thức để hiển thị trang chỉnh sửa banner
    public function getEdit($id)
    {
        // Tìm banner theo id
        $banners = Banners::find($id);
        // Trả về view 'admin.banners.edit' với dữ liệu banner
        return view('admin.banners.edit', ['banners' => $banners]);
    }

    // Phương thức để xử lý yêu cầu tạo mới banner
    public function postCreate(Request $request)
    {
        // Kiểm tra nếu có file hình ảnh được upload
        if ($request->hasFile('Image')) {
            foreach ($request->file('Image') as $file) {
                // Lấy định dạng file
                $format = $file->getClientOriginalExtension();
                // Kiểm tra định dạng file có hợp lệ không
                if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                    return redirect('admin/banners/add')->with('thongbao', 'Không hỗ trợ ' . $format);
                }
                // Lấy tên gốc của file
                $name = $file->getClientOriginalName();
                // Tạo tên file mới ngẫu nhiên
                $img = Str::random(4) . '-' . $name;
                // Đảm bảo tên file là duy nhất
                while (file_exists("user_asset/images/banners/" . $img)) {
                    $img = Str::random(4) . '-' . $name;
                }
                // Di chuyển file đến thư mục đích
                $file->move('user_asset/images/banners/', $img);
                // Gán tên file vào request
                $request['image'] = $img;
                // Tạo banner mới với dữ liệu từ request
                Banners::create($request->all());
            }
        }
        // Chuyển hướng về danh sách banners với thông báo thành công
        return redirect('admin/banners/list')->with('thongbao', 'Thêm thành công');
    }

    // Phương thức để xử lý yêu cầu chỉnh sửa banner
    public function postEdit(Request $request, $id)
    {
        // Tìm banner theo id
        $banners = Banners::find($id);
        // Kiểm tra nếu có file hình ảnh mới được upload
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            // Kiểm tra định dạng file có hợp lệ không
            if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                return redirect('admin/banners/create')->with('thongbao', 'Không hỗ trợ ' . $format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;
            // Đảm bảo tên file là duy nhất
            while (file_exists('user_asset/images/banners/' . $img)) {
                $img = Str::random(4) . '-' . $name;
            }
            // Di chuyển file đến thư mục đích
            $file->move('user_asset/images/banners/', $img);
            // Xóa file hình ảnh cũ nếu có
            if ($banners->image != '') {
                unlink('user_asset/images/banners/' . $banners->image);
            }
            // Gán tên file mới vào request
            $request['image'] = $img;
        }
        // Cập nhật banner với dữ liệu từ request
        $banners->update($request->all());

        // Chuyển hướng về danh sách banners với thông báo thành công
        return redirect('admin/banners/list')->with('thongbao', 'Sửa thành công');
    }

    // Phương thức để kích hoạt banner
    public function postActive($id)
    {
        // Tìm banner theo id và cập nhật trạng thái active
        Banners::find($id)->update(['active' => 1]);
        // Chuyển hướng về danh sách banners với thông báo thành công
        return redirect('admin/banners/list')->with('thongbao', 'Update thành công');
    }

    // Phương thức để tắt kích hoạt banner
    public function postNoActive($id)
    {
        // Tìm banner theo id và cập nhật trạng thái không active
        Banners::find($id)->update(['active' => 0]);
        // Chuyển hướng về danh sách banners với thông báo thành công
        return redirect('admin/banners/list')->with('thongbao', 'Update thành công');
    }

    // Phương thức để xử lý xóa banner
    public function getDelete($id)
    {
        // Tìm banner theo id
        $image = Banners::find($id);
        // Kiểm tra nếu file hình ảnh tồn tại thì xóa nó
        if (File::exists('user_asset/images/banners/' . $image->image)) {
            File::delete('user_asset/images/banners/' . $image->image);
        }
        // Xóa banner khỏi cơ sở dữ liệu
        $image->delete();
        // Chuyển hướng về danh sách banners với thông báo thành công
        return redirect('admin/banners/list')->with('thongbao', 'Xóa Thành Công');
    }

    // Phương thức để xóa banner và trả về phản hồi JSON
    public function delete_banners($id)
    {
        // Tìm banner theo id
        $image = Banners::find($id);
        // Kiểm tra nếu file hình ảnh tồn tại thì xóa nó
        if (File::exists('user_asset/images/banners/' . $image->image)) {
            File::delete('user_asset/images/banners/' . $image->image);
        }
        // Xóa banner khỏi cơ sở dữ liệu
        $image->delete();
        // Trả về phản hồi JSON thông báo thành công
        return response()->json(['success' => 'Delete Successfully']);
    }

    // Phương thức để xóa nhiều banners và trả về phản hồi JSON
    public function deleteall_banners(Request $request)
    {
        // Lấy danh sách id của banners cần xóa từ request
        $ids = $request->ids;
        // Lấy tất cả banners
        $banners = Banners::all();
        // Lặp qua danh sách banners để xóa file hình ảnh
        foreach ($banners as $img) {
            if (File::exists('user_asset/images/banners/' . $img->image)) {
                File::delete('user_asset/images/banners/' . $img->image);
            }
        }
        // Xóa các banners khỏi cơ sở dữ liệu
        Banners::whereIn('id', explode(',', $ids))->delete();
        // Trả về phản hồi JSON thông báo thành công
        return response()->json(['success' => "Banners deleted successfully."]);
    }
}
