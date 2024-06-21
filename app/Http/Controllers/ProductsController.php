<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Subcategories;
use App\Models\User;
use App\Models\Brands;
use App\Models\Imagelibrary;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function list(Request $request)
    {
        $brands = Brands::all();
        $users = User::all();
        $categories = Categories::all();

        $query = Products::orderBy('id', 'DESC');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                ->orWhereHas('categories', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('subcategories', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('brands', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        }

        $products = $query->paginate(10);

        return view('admin.products.list', compact('products', 'categories', 'users', 'brands'));
    }

    public function getCreate()
    {
        $brands = Brands::all();
        $products = Products::all();
        $categories = Categories::all();
        $subcategories = Subcategories::all();
        $imagelibrary = Imagelibrary::all();

        return view('admin.products.create', compact('categories', 'products', 'brands', 'imagelibrary', 'subcategories'));
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.min' => 'Tên sản phẩm ít nhất 1 ký tự',
        ]);

        $request['users_id'] = Auth::user()['id'];

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();

            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('admin/products/create')->with('thongbao', __('lang.unsupported_file') . $format);
            }

            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;

            while (file_exists('user_asset/images/products/' . $img)) {
                $img = Str::random(4) . '-' . $name;
            }

            $file->move('user_asset/images/products', $img);
            $request['image'] = $img;
        }

        $products = new Products($request->all());
        $products->save();

        if ($request->hasFile('Imagelibrary')) {
            foreach ($request->file('Imagelibrary') as $file) {

                $format = $file->getClientOriginalExtension();

                if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                    return redirect('admin/products/add')->with('thongbao', __('lang.unsupported_file') . $format);
                }

                $name = $file->getClientOriginalName();
                $img = Str::random(4) . '-' . $name;

                while (file_exists("user_asset/images/products/" . $img)) {
                    $img = Str::random(4) . '-' . $name;
                }

                $request['products_id'] = $products->id;
                $request['image_library'] = $img;

                $file->move('user_asset/images/products', $img);
                Imagelibrary::create($request->all());
            }
        }

        return redirect('admin/products/list')->with('thongbao', __('lang.add_successful'));
    }

    public function getEdit($id)
    {
        $subcategories = Subcategories::all();
        $imagelibrary = Imagelibrary::all();
        $products = Products::find($id);
        $categories = Categories::all();
        $brands = Brands::all();

        return view('admin.products.edit', compact('categories', 'products', 'brands', 'imagelibrary', 'subcategories'));
    }

    public function postEdit(Request $request, $id)
    {
        $products = Products::find($id);

        $request->validate([
            'name' => 'required|min:1',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.min' => 'Tên sản phẩm ít nhất 1 ký tự',
        ]);

        $request['users_id'] = Auth::user()['id'];

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();

            if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                return redirect('admin/products/list')->with('thongbao', __('lang.unsupported_file') . $format);
            }

            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;

            while (file_exists('user_asset/images/products/' . $img)) {
                $img = Str::random(4) . '-' . $name;
            }

            $file->move('user_asset/images/products', $img);

            if ($products['image'] != '') {
                File::delete('user_asset/images/products/' . $products['image']);
            }

            $request['image'] = $img;
        }

        if ($request->hasFile('imagelibrary')) {
            foreach ($request->file('imagelibrary') as $file) {

                $format = $file->getClientOriginalExtension();

                if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                    return redirect('admin/products/add')->with('thongbao', __('lang.unsupported_file') . $format);
                }

                $name = $file->getClientOriginalName();
                $img = Str::random(4) . '-' . $name;

                while (file_exists("user_asset/images/products/" . $img)) {
                    $img = Str::random(4) . '-' . $name;
                }

                $file->move('user_asset/images/products', $img);
                $request['products_id'] = $id;
                $request['image_library'] = $img;
                Imagelibrary::create($request->all());
            }
        }

        Products::find($id)->update($request->all());
        return redirect('admin/products/list')->with('thongbao', __('lang.update_successful'));
    }

    public function Deleteimages($id)
    {
        $imagelibrary = Imagelibrary::find($id);

        if (File::exists('user_asset/images/products/' . $imagelibrary->image_library)) {
            File::delete('user_asset/images/products/' . $imagelibrary->image_library);
        }

        $imagelibrary->delete();

        return response()->json(['success' => __('lang.delete_successful')]);
    }

    public function delete_products($id)
    {
        $image = Products::find($id);
        $imagelibrary = Imagelibrary::where('products_id', $image->id)->get();

        if (File::exists('user_asset/images/products/' . $image->image)) {
            File::delete('user_asset/images/products/' . $image->image);
        }

        foreach ($imagelibrary as $img) {
            if (File::exists('user_asset/images/products/' . $img->image_library)) {
                File::delete('user_asset/images/products/' . $img->image_library);
            }
        }

        $image->delete();

        return response()->json(['success' => __('lang.delete_successful')]);
    }
}
