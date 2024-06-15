<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Orders;
use App\Models\About;
use App\Models\Orders_Detail;
use App\Models\Rating;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // Hàm khởi tạo, được gọi khi controller này được khởi tạo
    function __construct()
    {
        $sum = 0;
        $rating = Rating::all();
        $orders_new = Orders_Detail::get()->sortByDesc('created_at')->take(1);
        $orders = Orders::all();
        $orders_detail = Orders_Detail::all();
        $orders_detail_new = Orders_Detail::get()->sortByDesc('created_at')->take(1);
        $user_new = User::get()->sortByDesc('created_at')->take(1);
        $user = User::all();

        // Chia sẻ dữ liệu với tất cả các view
        view()->share('user', $user);
        view()->share('user_new', $user_new);
        view()->share('orders_detail_new', $orders_detail_new);
        view()->share('orders_detail', $orders_detail);
        view()->share('orders', $orders);
        view()->share('sum', $sum);
        view()->share('orders_new', $orders_new);
        view()->share('rating', $rating);
    }

    // Hiển thị trang chủ admin
    public function home()
    {
        $sum = 0;
        $orders = Orders::all();
        foreach ($orders as $value) {
            if ($value['status'] == 3) {
                $sum +=  $value['total'];
            }
        }
        return view('admin.home.list', ['sum' => $sum]);
    }

    // Hiển thị trang hồ sơ người dùng
    public function profile()
    {
        if (Auth::check()) {
            $user = Auth()->user();
        } else {
            return redirect('admin/login');
        }
        return view('admin.profile', [
            'user' => $user
        ])->with('roles', 'permissions');
    }

    // Chỉnh sửa hồ sơ người dùng
    public function edit_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required'
        ], [
            'firstname.required' => 'Vui lòng nhập tên',
            'lastname.required' => 'Vui lòng nhập họ'
        ]);

        if ($request['changepasswordprofile'] == 'on') {
            $request->validate([
                'password' => 'required',
                'passwordagain' => 'required|same:password'
            ], [
                'password.required' => 'Vui lòng nhập mật khẩu mới',
                'passwordagain.required' => 'Vui lòng nhập lại mật khẩu mới',
                'passwordagain.same' => 'Mật khẩu nhập lại không đúng'
            ]);
            $request['password'] = bcrypt($request['password']);
        }

        $user->update($request->all());

        return redirect('admin/profile')->with('thongbao', 'Cập nhật thành công');
    }

    // Chỉnh sửa ảnh đại diện
    public function edit_img(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->hasFile('Image')) {
            $file =  $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('admin/profile')->with('thongbao', 'Không hỗ trợ ' . $format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;
            while (file_exists("upload/avatar" . $img)) {
                $img = Str::random(4) . '-' . $name;
            }
            $file->move('upload/avatar/', $img);
            if ($user['image'] != '') {
                if ($user['image'] != 'avatar.jpg') {
                    unlink('upload/avatar/' . $user->image);
                }
            }
            User::where('id', Auth::user()->id)->update(['image' => $img]);
        }
        return redirect('admin/profile')->with('thongbao', 'Update successfully!');
    }

    // Chỉnh sửa liên kết Facebook
    public function edit_facebook(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update($request->all());
        return redirect('admin/profile')->with('thongbao', 'Update successfully!');
    }

    // Hiển thị trang đăng nhập
    public function getLogin()
    {
        return view('admin.login');
    }

    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => "Vui lòng nhập username",
            'password.required' => "Vui lòng nhập mật khẩu"
        ]);

        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            return redirect('admin');
        } else {
            return redirect('admin/login')->with('canhbao', 'Đăng nhập không thành công');
        }
    }

    // Xử lý đăng xuất
    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }

    // Hiển thị danh sách người dùng
    public function list()
    {
        $users = User::with('roles', 'permissions')->orderBy('id', 'DESC')->get();
        return view('admin.staff.list', [
            'users' => $users,
        ]);
    }

    // Hiển thị trang tạo người dùng mới
    public function getcreate()
    {
        $role = Role::orderBy('id', 'ASC')->get();
        return view('admin/staff/create', ['role' => $role]);
    }

    // Xử lý tạo người dùng mới
    public function postcreate(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:1',
            'lastname' => 'required|min:1',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'passwordagain' => 'required|same:password'
        ], [
            'firstname.required' => 'Vui lòng nhập tên',
            'firstname.min' => 'Tên ít nhất 1 kí tự',
            'lastname.required' => 'Vui lòng nhập họ',
            'lastname.min' => 'Họ ít nhất 1 kí tự',
            'username.required' => 'Vui lòng nhập username',
            'username.unique' => 'username đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'passwordagain.required' => 'Vui lòng nhập lại mật khẩu',
            'passwordagain.same' => 'Mật khẩu nhập lại không trùng'
        ]);

        $request['password'] = bcrypt($request['password']);
        $request['image'] = 'avatar.jpg';
        $user = User::create($request->all());
        $user->syncRoles('staff');
        return redirect('admin/staff/list')->with('thongbao', 'Thêm thành công');
    }

    // Hiển thị trang chỉnh sửa người dùng
    public function getEdit($id)
    {
        $role = Role::all();
        $user = User::find($id);
        $all_role = $user->roles->first();
        return view('admin.staff.edit', ['user' => $user, 'role' => $role, 'all_role' => $all_role]);
    }

    // Xử lý chỉnh sửa người dùng
    public function postEdit(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|min:1',
            'lastname' => 'required|min:1',
            'username' => 'required',
            'email' => 'required'
        ], [
            'firstname.required' => 'Vui lòng nhập tên',
            'firstname.min' => 'Tên ít nhất 1 kí tự',
            'lastname.required' => 'Vui lòng nhập họ',
            'lastname.min' => 'Họ ít nhất 1 kí tự',
            'username.required' => 'Vui lòng nhập username',
            'email.required' => 'Vui lòng nhập email',
        ]);

        if ($request['changepassword'] == 'on') {
            $request->validate([
                'password' => 'required',
                'passwordagain' => 'required|same:password'
            ], [
                'password.unique' => 'Mật khẩu mới trùng với mật khẩu cũ',
                'password.required' => 'Vui lòng nhập mật khẩu mới',
                'passwordagain.required' => 'Vui lòng nhập lại mật khẩu mới',
                'passwordagain.same' => 'Mật khẩu nhập lại không đúng'
            ]);
            $request['password'] = bcrypt($request['password']);
        }

        $user = User::find($id);
        $user->update($request->all());
        return redirect('admin/staff/list')->with('thongbao', 'Thành công');
    }

    // Hiển thị trang quản lý vai trò của người dùng
    public function getrole($id)
    {
        $user = User::find($id);
        $role = Role::all();
        $all_role = $user->roles->first();
        $permission = Permission::all();
        return view('admin.staff.role', ['role' => $role, 'user' => $user, 'all_role' => $all_role, 'permission' => $permission]);
    }

    // Xử lý cập nhật vai trò của người dùng
    public function postrole(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        return redirect('admin/staff/list')->with('thongbao', 'Update vai trò thành công');
    }

    // Hiển thị trang quản lý quyền hạn của người dùng
    public function getpermission($id)
    {
        $user = User::find($id);
        $permission = Permission::orderBy('id', 'asc')->get();
        $user_per = $user->getDirectPermissions();
        return view('admin.staff.permission', ['user' => $user, 'permission' => $permission, 'user_per' => $user_per]);
    }

    // Xử lý cập nhật quyền hạn của người dùng
    public function postpermission(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->syncPermissions($data['permission']);
        return redirect('admin/staff/list')->with('thongbao', 'Thêm quyền thành công');
    }

    // Hiển thị trang danh sách đánh giá
    public function getRating()
    {
        $rating = Rating::all();
        return view('admin.rating.list', ['rating' => $rating]);
    }
}
