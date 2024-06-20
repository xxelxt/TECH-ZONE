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
        $banners = Banners::orderBy('id', 'DESC')->paginate(10);
        return view('admin.banners.list', ['banners' => $banners]);
    }

    public function getCreate()
    {
        return view('admin.banners.create');
    }

    public function getEdit($id)
    {
        $banners = Banners::find($id);
        return view('admin.banners.edit', ['banners' => $banners]);
    }

    public function postCreate(Request $request)
    {
        // Kiểm tra nếu có file hình ảnh được upload
        if ($request->hasFile('Image')) {
            foreach ($request->file('Image') as $file) {

                // Lấy định dạng file
                $format = $file->getClientOriginalExtension();

                // Kiểm tra định dạng file có hợp lệ không
                if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                    return redirect('admin/banners/add')->with('thongbao', __('lang.unsupported_file') . $format);
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

                Banners::create($request->all());
            }
        }

        return redirect('admin/banners/list')->with('thongbao', __('lang.add_successful'));
    }

    public function postEdit(Request $request, $id)
    {
        $banners = Banners::find($id);

        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();

            // Kiểm tra định dạng file có hợp lệ không
            if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                return redirect('admin/banners/create')->with('thongbao', __('lang.unsupported_file') . $format);
            }

            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;

            while (file_exists('user_asset/images/banners/' . $img)) {
                $img = Str::random(4) . '-' . $name;
            }

            $file->move('user_asset/images/banners/', $img);

            // Xóa file hình ảnh cũ nếu có
            if ($banners->image != '') {
                unlink('user_asset/images/banners/' . $banners->image);
            }

            $request['image'] = $img;
        }
        $banners->update($request->all());

        return redirect('admin/banners/list')->with('thongbao', __('lang.update_successful'));
    }

    public function postActive($id)
    {
        Banners::find($id)->update(['active' => 1]);
        return redirect('admin/banners/list')->with('thongbao', __('lang.update_successful'));
    }

    public function postNoActive($id)
    {
        Banners::find($id)->update(['active' => 0]);
        return redirect('admin/banners/list')->with('thongbao', __('lang.update_successful'));
    }

    public function getDelete($id)
    {
        $image = Banners::find($id);

        // Kiểm tra nếu file hình ảnh tồn tại thì xóa nó
        if (File::exists('user_asset/images/banners/' . $image->image)) {
            File::delete('user_asset/images/banners/' . $image->image);
        }

        $image->delete();

        return redirect('admin/banners/list')->with('thongbao', __('lang.delete_successful'));
    }

    public function deleteall_banners(Request $request)
    {
        $ids = $request->ids;
        $banners = Banners::all();

        foreach ($banners as $img) {
            if (File::exists('user_asset/images/banners/' . $img->image)) {
                File::delete('user_asset/images/banners/' . $img->image);
            }
        }

        Banners::whereIn('id', explode(',', $ids))->delete();

        return redirect('admin/banners/list')->with('thongbao', __('lang.delete_successful'));
    }
}
