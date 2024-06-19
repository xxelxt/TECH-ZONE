<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesController extends Controller
{
    // Hàm list() để lấy danh sách tất cả các vai trò và trả về view hiển thị danh sách
    public function list()
    {
        $roles=Role::all();
        return view('admin.roles.list',['roles' => $roles]);
    }

    // Hàm getCreate() để hiển thị form tạo mới vai trò và trả về view tạo mới cùng danh sách quyền
    public function getCreate()
    {
        $permission = Permission::all();
        return view('admin.roles.create',['permission'=>$permission]);
    }

    // Hàm getEdit($id) để hiển thị form chỉnh sửa thông tin vai trò dựa trên ID và trả về view chỉnh sửa
    public function getEdit($id)
    {
        $roles= Role::find($id);
        return view('admin.roles.edit',['roles'=>$roles]);
    }

    // hàm xử lý tạo mới, chỉnh sửa và xóa vai trò

    public function postCreate(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles'
        ],[
            'name.required'=>'Vui lòng nhập tên vai trò',
            'name.unique'=>'Tên vai trò này đã tồn tại'
        ]);
        
        Role::create($request->all());
        return redirect('admin/roles/list')->with('thongbao','Thêm thành công');
    }
    public function postEdit(Request $request,$id)
    {
        $roles = Role::find($id);
        $request->validate([
            'name'=>'required|unique:roles'
        ],[
            'name.required'=>'Vui lòng nhập tên vai trò',
            'name.unique'=>'Tên vai trò này đã tồn tại'
        ]);
        $roles->update($request->all());
        return redirect('admin/roles/list')->with('thongbao','Update thành công');
    }
    public function Delete($id)
    {
        Role::destroy($id);
        return redirect('admin/roles/list')->with('thongbao','Xóa thành công');
    }

}
