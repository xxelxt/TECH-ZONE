<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discounts;

class DiscountsController extends Controller
{
    public function list(Request $request)
    {
        $query = Discounts::orderBy('id', 'DESC');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('code', 'like', "%$search%")
                ->orWhere('discounts', 'like', "%$search%");
        }

        $discounts = $query->paginate(10);
        return view('admin.discounts.list', ['discounts' => $discounts]);
    }

    public function getEdit($id)
    {
        $discounts = Discounts::find($id);
        return view('admin.discounts.edit', ['discounts' => $discounts]);
    }

    public function getCreate()
    {
        return view('admin.discounts.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discounts',
            'discounts' => 'numeric|min:0|max:100'
        ], [
            'code.required' => 'Vui lòng nhập mã giảm giá',
            'code.unique' => 'Mã giảm giá này đã tồn tại',
            'discounts.max' => 'Mã giảm giá tối đa là 100',
            'discounts.min' => 'Mã giảm giá tối thiểu là 0'
        ]);

        Discounts::create($request->all());

        return redirect('admin/discounts/list')->with('thongbao', __('lang.add_successful'));
    }

    public function postEdit(Request $request, $id)
    {
        $discounts = Discounts::find($id);

        $request->validate([
            'code' => 'required',
            'discounts' => 'numeric|min:0|max:100'
        ], [
            'code.required' => 'Vui lòng nhập mã giảm giá',
            'discounts.max' => 'Mã giảm giá tối đa là 100',
            'discounts.min' => 'Mã giảm giá tối thiểu là 0'
        ]);

        $discounts->update($request->all());

        return redirect('admin/discounts/list')->with('thongbao', __('lang.update_successful'));
    }

    public function delete_discounts($id)
    {
        Discounts::destroy($id);
        return response()->json(['success' => __('lang.delete_successful')]);
    }

    public function deleteall_discounts(Request $request)
    {
        $ids = $request->ids;

        Discounts::whereIn('id', explode(',', $ids))->delete();

        return response()->json(['success' => __('lang.delete_successful')]);
    }
}
