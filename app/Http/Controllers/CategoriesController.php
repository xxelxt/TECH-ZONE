<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Subcategories;

class CategoriesController extends Controller
{
    public function list(Request $request)
    {
        $query = Categories::orderBy('id', 'DESC');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        $categories = $query->paginate(10);
        return view('admin.categories.list', ['categories' => $categories]);
    }

    public function getEdit($id)
    {
        $categories = Categories::find($id);
        return view('admin.categories.edit', ['categories' => $categories]);
    }

    public function getCreate()
    {
        return view('admin.categories.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ], [
            'name.required' => "Vui lòng nhập tên danh mục",
            'name.unique' => 'Tên danh mục này đã tồn tại'
        ]);

        Categories::create($request->all());

        return redirect('admin/categories/list')->with('thongbao', __('lang.add_successful'));
    }

    public function postEdit(Request $request, $id)
    {
        $categories = Categories::find($id);

        $request->validate([
            'name' => 'required|unique:categories'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục này đã tồn tại'
        ]);

        $categories->update($request->all());

        return redirect('admin/categories/list')->with('thongbao', __('lang.update_successful'));
    }

    public function delete_categories($id)
    {
        $check = count(Subcategories::where('cat_id', $id)->get());
        if ($check == 0) {
            Categories::destroy($id);
            return response()->json(['success' => __('lang.delete_successful')]);
        } else {
            return response()->json(['error' => __('lang.delete_error_cat')]);
        }
    }

    public function deleteall_categories(Request $request)
    {
        $ids = $request->ids;
        $check = count(Subcategories::where('cat_id', $ids)->get());
        if ($check != 0) {
            return response()->json(['error' => __('lang.delete_error_cat')]);
        } else {
            Categories::whereIn('id', explode(',', $ids))->delete();
            return response()->json(['success' => __('lang.delete_successful')]);
        }
    }
}
