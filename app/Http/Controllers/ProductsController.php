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
    // Hiển thị danh sách sản phẩm
    public function list()
    {
        // Lấy danh sách thương hiệu, người dùng, danh mục và sản phẩm, sắp xếp theo id giảm dần, mỗi trang có tối đa 5 sản phẩm
        $brands = Brands::all();
        $users = User::all();
        $categories = Categories::all();
        $products = Products::orderBy('id', 'DESC')->paginate(5);
        // Trả về view 'admin.products.list' với biến 'products' chứa danh sách sản phẩm và các biến khác
        return view('admin.products.list', compact('products', 'categories', 'users', 'brands'));
    }

    // Hiển thị form thêm mới sản phẩm
    public function getCreate()
    {
        // Lấy danh sách thương hiệu, danh mục, danh sách sản phẩm, danh sách danh mục con và thư viện hình ảnh
        $brands = Brands::all();
        $products = Products::all();
        $categories = Categories::all();
        $subcategories = Subcategories::all();
        $imagelibrary = Imagelibrary::all();
        // Trả về view 'admin.products.create' với các biến chứa thông tin cần thiết
        return view('admin.products.create', compact('categories', 'products', 'brands', 'imagelibrary', 'subcategories'));
    }

    // Xử lý thêm mới sản phẩm
    public function postCreate(Request $request)
    {
        // Kiểm tra dữ liệu được gửi từ form
        $request->validate([
            'name' => 'required|min:1',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.min' => 'Tên sản phẩm ít nhất 1 ký tự',
        ]);

        // Thêm id người dùng hiện tại vào dữ liệu gửi từ form
        $request['users_id'] = Auth::user()['id'];

        // Xử lý ảnh đại diện sản phẩm
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('admin/products/create')->with('thongbao', 'Không hỗ trợ ' . $format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4) . '-' . $name;
            while (file_exists('user_asset/images/products/' . $img)) {
                $img = Str::random(4) . '-' . $name;
            }
            $file->move('user_asset/images/products', $img);
            $request['image'] = $img;
        }

        // Tạo mới sản phẩm và lưu vào CSDL
        $products = new Products($request->all());
        $products->save();

        // Xử lý thêm ảnh từ thư viện
        if ($request->hasFile('Imagelibrary')) {
            foreach ($request->file('Imagelibrary') as $file) {
                $format = $file->getClientOriginalExtension();
                if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                    return redirect('admin/products/add')->with('thongbao', 'Không hỗ trợ ' . $format);
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

        // Chuyển hướng về trang danh sách sản phẩm và thông báo thêm thành công
        return redirect('admin/products/list')->with('thongbao', 'Thêm thành công');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function getEdit($id)
    {
        // Lấy danh sách danh mục, thương hiệu, sản phẩm, danh sách danh mục con và thư viện hình ảnh
        $subcategories = Subcategories::all();
        $imagelibrary = Imagelibrary::all();
        $products = Products::find($id);
        $categories = Categories::all();
        $brands = Brands::all();
        // Trả về view 'admin.products.edit' với các biến chứa thông tin cần thiết
        return view('admin.products.edit', compact('categories', 'products', 'brands', 'imagelibrary', 'subcategories'));
    }

    // Xử lý chỉnh sửa sản phẩm
    public function postEdit(Request $request, $id)
    {
        // Tìm sản phẩm dựa trên id
        $products = Products::find($id);

        // Kiểm tra dữ liệu được gửi từ form
        $request->validate([
            'name' => 'required|min:1',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.min' => 'Tên sản phẩm ít nhất 1 ký tự',
        ]);

        // Thêm id người dùng hiện tại vào dữ liệu gửi từ form
        $request['users_id'] = Auth::user()['id'];

        // Xử lý ảnh đại diện sản phẩm
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/products/list')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('user_asset/images/products/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('user_asset/images/products',$img);
            if($products['image'] !='')
            {
                File::delete('user_asset/images/products/'.$products['image']);
            }
            $request['image'] = $img;
        }
        if($request->hasFile('imagelibrary'))
        {
         foreach( $request->file('imagelibrary') as $file)
         {
             $format = $file->getClientOriginalExtension();
             if($format !='jpg' && $format !='jpeg' && $format !='png')
             {
                 return redirect('admin/products/add')->with('thongbao','Không hỗ trợ '.$format);
             }
             $name = $file->getClientOriginalName();
             $img = Str::random(4).'-'.$name;
             while(file_exists("user_asset/images/products/".$img))
             {
              $img = Str::random(4).'-'.$name;
             }
             $file->move('user_asset/images/products',$img);
             $request['products_id'] =  $id;
             $request['image_library'] = $img;    
             Imagelibrary::create($request->all()); 
         }
        }
        Products::find($id)->update($request->all());
        return redirect('admin/products/list')->with('thongbao','Update thành công');
    }

    public function Deleteimages($id)
    {
        $imagelibrary = Imagelibrary::find($id);
        if(File::exists('user_asset/images/products/'.$imagelibrary->image_library))
        {
            File::delete('user_asset/images/products/'.$imagelibrary->image_library);
        }
        $imagelibrary->delete();
        return response()->json(['success' => 'Delete Successfully']);
        // return redirect()->back();
    }
    
    public function delete_products($id)
    {
        $image = Products::find($id);
        $imagelibrary= Imagelibrary::where('products_id',$image->id)->get();
        if(File::exists('user_asset/images/products/'.$image->image))
        {
            File::delete('user_asset/images/products/'.$image->image);
        }
        foreach($imagelibrary as $img)
        {
            if(File::exists('user_asset/images/products/'.$img->image_library))
            {
                File::delete('user_asset/images/products/'.$img->image_library);
            }
        }
        $image->delete();
        return response()->json(['success' => 'Delete Successfully']);
       
    }
}