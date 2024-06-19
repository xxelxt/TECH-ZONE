<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Hiển thị trang chỉnh sửa thông tin "About".
     */

    public function getEdit()
    {
        $about = About::find(1); // Tìm đối tượng "About" có ID là 1
        return view('admin.about.details', [
            'about' => $about // Truyền đối tượng "About" sang view
        ]);
    }

    /**
     * Xử lý dữ liệu khi người dùng gửi biểu mẫu chỉnh sửa thông tin "About".
     */
    public function postEdit(Request $request)
    {
        $about = About::find(1); // Tìm đối tượng "About" có ID là 1

        // Kiểm tra xem người dùng có tải lên file hình ảnh không
        if ($request->hasFile('Image')) {
            $file = $request->file('Image'); // Lấy file ảnh từ request
            $format = $file->getClientOriginalExtension(); // Lấy định dạng của file ảnh

            // Kiểm tra định dạng file ảnh có hợp lệ không
            if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                return redirect('admin/about')->with('thongbao', 'Không hỗ trợ ' . $format);
            }

            $name = $file->getClientOriginalName(); // Lấy tên gốc của file ảnh
            $img = Str::random(4) . '-' . $name; // Tạo tên mới cho file ảnh bằng cách thêm chuỗi ngẫu nhiên

            // Kiểm tra xem tên file ảnh mới đã tồn tại hay chưa, nếu có thì tạo tên mới
            while (file_exists('upload/logos/' . $img)) {
                $img = Str::random(4) . '-' . $name;
            }

            // Di chuyển file ảnh vào thư mục 'upload/logos'
            $file->move('upload/logos', $img);

            // Nếu đối tượng "About" đã có logo cũ, thì xóa file logo cũ
            if ($about->logo != '') {
                unlink('upload/logos/' . $about->logo);
            }

            // Cập nhật tên file ảnh mới vào request
            $request['logo'] = $img;
        }

        // Cập nhật thông tin "About" với dữ liệu từ request
        $about->update($request->all());

        // Chuyển hướng về trang "About" với thông báo thành công
        return redirect('admin/about')->with('thongbao', 'Thành công');
    }
}
