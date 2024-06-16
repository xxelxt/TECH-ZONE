<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\User;
use App\Models\About;
use App\Models\Brands;
use App\Models\Rating;
use App\Models\Banners;
use App\Models\Products;
use App\Models\Wishlist;
use App\Models\Discounts;
use App\Models\Orders;
use App\Models\Orders_Detail;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\Imagelibrary;
use Illuminate\Http\Request;
use App\Models\SubCategories;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Phương thức khởi tạo để chia sẻ dữ liệu chung qua các view
    function __construct()
    {
        // Lấy dữ liệu từ các model khác nhau và chia sẻ chúng với các view
        $user = User::all();
        $subcategories = SubCategories::where('active', 1)->orderBy('id', 'ASC')->get();
        $categories = Categories::where('active', 1)->orderBy('id', 'ASC')->get();
        $discounts = Discounts::all();
        $products = Products::where('active', 1)->orderBy('id', 'ASC')->get();
        $banners = Banners::where('active', 1)->orderBy('id', 'ASC')->get();
        $about = About::find(1);
        $brands = Brands::where('active', 1)->orderBy('id', 'ASC')->get();
        $image = Imagelibrary::all();
        $new_products = Products::get()->where('active', 1)->sortByDesc('created_at')->take(10);
        $wishlist = new Wishlist;
        view()->share('about', $about);
        view()->share('banners', $banners);
        view()->share('brands', $brands);
        view()->share('products', $products);
        view()->share('discounts', $discounts);
        view()->share('categories', $categories);
        view()->share('subcategories', $subcategories);
        view()->share('user', $user);
        view()->share('image', $image);
        view()->share('new_products', $new_products);
        view()->share('wishlist', $wishlist);
    }
    // Phương thức để hiển thị trang chủ
    public function home()
    {

        return view('user.pages.home');
    }

    // Phương thức để hiển thị trang danh sách người dùng (chỉ có quản trị viên mới được truy cập)
    public function list()
    {
        // Lấy và chuyển dữ liệu người dùng đến view
        $users = User::with('roles', 'permissions')->get();
        return view('admin.user.list', [
            'users' => $users
        ]);
    }
    //     public function index()
    //     {
    //         $user_id = Auth::user()->id;
    //         $data = Auth::user()->roles;
    //         dd($data);
    //         // $arrPermission = [];
    //         // foreach($data as $value) $arrPermission[] = $value->name;
    //         // $collection = new Collection($arrPermission);
    //         // dd($collection->contains("all_product"));
    //  }

    // Phương thức để xóa một nhân viên (chỉ có quản trị viên mới được thực hiện)
    public function delete_staff($id)
    {
        $user = User::find($id);
        if ($user['active'] == 0) {
            if ($user->hasRole('admin')) {
                return response()->json(['error' => "Can't delete admin account"]);
            } else {
                $user->delete($id);
                if ($user['image'] != 'avatar.jpg') {
                    File::delete('upload/avatar/' . $user['image']);
                }
                return response()->json(['success' => 'Delete Successfully']);
            }
        } else {
            return response()->json(['error' => "Can't delete because Status being activated "]);
        }
    }

    // Phương thức để xóa một đánh giá
    public function delete_rating($id)
    {
        $rating = Rating::find($id);
        $rating->delete($id);
        return response()->json(['success' => 'Delete Successfully']);
    }

    // Phương thức để hiển thị form đăng ký người dùng
    public function get_register()
    {
        return view('user.register');
    }

    // Phương thức để xử lý việc đăng ký người dùng
    public function post_register(Request $request)
    {
        // Xác thực dữ liệu đăng ký người dùng và tạo một người dùng mới
        $request->validate([
            'firstname' => 'required|min:1',
            'lastname' => 'required|min:1',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'passwordagain' => 'required|same:password',
        ], [
            'firstname.required' => 'Firstname is required',
            'lastname.required' => 'Lastname is required',
            'username.required' => 'Username is required',
            'username.unique' => 'Username already exists',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'passwordagain.required' => 'Password is required',
            'passwordagain.same' => "Password doesn't match",
        ]);
        $request['password'] = bcrypt($request['password']);
        $request['image'] = 'avatar.jpg';
        $user = User::create($request->all());
        $user->syncRoles('user');
        return redirect('login')->with('thongbao', 'Sign up successfully');
    }

    // Phương thức để hiển thị form đăng nhập người dùng
    public function get_login()
    {
        return view('user.login');
    }

    // Phương thức để xử lý việc đăng nhập người dùng
    public function post_login(Request $request)
    {
        // Xác thực dữ liệu đăng nhập người dùng và thử đăng nhập
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Please enter username',
            'password.required' => 'Please enter password'
        ]);

        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            return redirect('/');
        } else {
            return redirect('/login')->with('canhbao', 'Sign in unsuccessfully');
        }
    }

    // phương thức log out
    public function logout()
    {
        Auth::logout();
        Cart::destroy();
        return redirect('/'); // di chuyển về trang đăng nhập
    }

    // Phương thức để hiển thị trang hồ sơ người dùng
    public function profile()
    {
        // Hiển thị trang hồ sơ người dùng
        if (Auth::check()) {
            $user = Auth()->user();
        } else {
            return redirect('/login');
        }
        return view('user.profile', ['user' => $user]);
    }

    // Phương thức để hiển thị trang chi tiết sản phẩm
    public function product_deltails($id)
    {
        // Lấy và hiển thị chi tiết sản phẩm cùng với các sản phẩm liên quan và đánh giá
        $pro = Products::all();
        $products = Products::find($id);
        $related_products = Products::where('sub_id', $products['sub_id'])->take(4)->get();
        $wishlist = new Wishlist;
        $countWishlist = $wishlist->countWishlist($products['id']);
        $ratings = Rating::where('products_id', $id)->orderBy('id', 'DESC')->get();
        // dd($ratings);
        // die;
        return view('user.pages.product_details', [
            'products' => $products,
            'related_products' => $related_products, 'countWishlist' => $countWishlist,
            'pro' => $pro, 'ratings' => $ratings
        ]);
    }

    // Phương thức để hiển thị trang lưới sản phẩm theo danh mục
    public function product_grid($id)
    {
        // Hiển thị trang lưới sản phẩm theo danh mục
        $danhmuc = Categories::find($id);
        $categories = Categories::all();
        $products = Products::where('active', 1)->where('categories_id', $id)->orderBy('id', 'ASC')->Paginate(12);
        $count = count($products);
        $wishlist = new Wishlist;
        return view('user.pages.product_grid', ['danhmuc' => $danhmuc, 'categories' => $categories, 'products' => $products, 'count' => $count, 'wishlist' => $wishlist]);
    }

    // Phương thức để hiển thị trang lưới sản phẩm theo danh mục phụ
    public function product_grid_sub($id)
    {
        // Hiển thị trang lưới sản phẩm theo danh mục phụ
        $danhmuc = SubCategories::find($id);
        $categories = Categories::all();
        $products = Products::where('active', 1)->where('sub_id', $id)->orderBy('id', 'ASC')->Paginate(12);
        $count = count($products);
        $wishlist = new Wishlist;
        return view('user.pages.product_grid_sub', ['danhmuc' => $danhmuc, 'categories' => $categories, 'products' => $products, 'count' => $count, 'wishlist' => $wishlist]);
    }

    // Phương thức để xử lý thêm/xóa sản phẩm vào/khỏi danh sách yêu thích
    public function wishlist(Request $request)
    {
        // Thêm/xóa sản phẩm vào/khỏi danh sách yêu thích và phản hồi với JSON
        if ($request->ajax()) {
            $data = $request->all();
            $wishlist = new Wishlist;
            $countWishlist = $wishlist->countWishlist($data['products_id']);
            if ($countWishlist == 0) {
                $wishlist->products_id = $data['products_id'];
                $wishlist->users_id = $data['users_id'];
                $wishlist->save();
                return response()->json(['action' => 'add', 'message' => 'Product Added Successfully to Wishlist']);
            } else {
                Wishlist::where(['users_id' => Auth::user()->id, 'products_id' => $data['products_id']])->delete();
                return response()->json(['action' => 'remove', 'message' => 'Product Remove Successfully to Wishlist']);
            }
        }
    }

    // Phương thức để lấy tổng số lượng mục yêu thích
    public function total_wishlist()
    {
        // Lấy tổng số lượng mục yêu thích và phản hồi với JSON
        $total_wishlist = Wishlist::where(['users_id' => Auth::user()->id])->count();
        echo json_encode($total_wishlist);
    }

    // Phương thức để hiển thị trang sản phẩm nổi bật
    public function product_featured_all()
    {
        // Hiển thị trang sản phẩm nổi bật
        $categories = Categories::all();
        $products = Products::where('active', 1)->where('featured_product', 1)->orderBy('id', 'ASC')->Paginate(12);
        $count = count($products);
        return view('user.pages.product_featured_all', ['products' => $products, 'categories' => $categories, 'count' => $count]);
    }

    // Phương thức để hiển thị trang sản phẩm mới nhất
    public function product_latest_all()
    {
        // Hiển thị trang sản phẩm mới nhất
        $categories = Categories::all();
        $products = Products::get()->where('active', 1)->sortByDesc('created_at')->take(21);
        $count = count($products);
        return view('user.pages.product_latest_all', ['products' => $products, 'categories' => $categories, 'count' => $count]);
    }

    // Phương thức để hiển thị trang sản phẩm giảm giá
    public function product_sale_all()
    {
        // Hiển thị trang sản phẩm giảm giá
        $categories = Categories::all();
        $products = Products::where('active', 1)->orderBy('id', 'ASC')->Paginate(12);
        $count = count($products);
        return view('user.pages.product_sale_all', ['count' => $count, 'products' => $products, 'categories' => $categories]);
    }


    // Phương thức để hiển thị trang tất cả sản phẩm
    public function product_all()
    {
        // Hiển thị trang tất cả sản phẩm

        $categories = Categories::all();
        $search = Products::where('active', 1)->orderBy('id', 'ASC')->Paginate(15);
        $count = count($search);
        $wishlist = new Wishlist;
        return view('user.pages.product_all', ['categories' => $categories, 'search' => $search, 'count' => $count, 'wishlist' => $wishlist]);
    }

    // Phương thức để xử lý tìm kiếm người dùng
    public function search_user(Request $request)
    {
        // Xử lý tìm kiếm người dùng và hiển thị trang tất cả sản phẩm tương ứng
        if ($request['search']) {
            $categories = Categories::all();
            $search = Products::where('active', 1)->where('name', 'LIKE', '%' . $request['search'] . '%')->latest()->Paginate(15);
            $count = count($search);
            return view('user.pages.product_all', ['categories' => $categories, 'search' => $search, 'count' => $count]);
        } else {
            return redirect()->back()->with('canhbao', 'Empty Search');
        }
    }

    // Phương thức để hiển thị trang sản phẩm theo thương hiệu
    public function product_brand($id)
    {
        // Hiển thị trang sản phẩm theo thương hiệu
        $danhmuc = Brands::find($id);
        $categories = Categories::all();
        $products = Products::where('active', 1)->where('brands_id', $id)->orderBy('id', 'ASC')->Paginate(15);
        $count = count($products);
        $wishlist = new Wishlist;
        return view('user.pages.product_brand', ['categories' => $categories, 'danhmuc' => $danhmuc, 'products' => $products, 'count' => $count, 'wishlist' => $wishlist]);
    }

    // Phương thức để hiển thị trang yêu thích
    public function wishlist_pages()
    {
        // Hiển thị trang yêu thích
        $pro_wish = Wishlist::all();
        $user = User::find(Auth::user()->id);
        $categories = Categories::all();
        $products = Products::where('users_id', $user)->orderBy('id', 'ASC')->Paginate(15);
        $count = count($products);
        $wishlist = new Wishlist;
        return view('user.pages.wishlist', ['categories' => $categories, 'products' => $products, 'count' => $count, 'wishlist' => $wishlist, 'pro_wish' => $pro_wish]);
    }

    // Phương thức để xử lý thêm đánh giá sản phẩm
    public function addRating(Request $request)
    {
        // Thêm đánh giá sản phẩm và chuyển hướng trở lại với thông báo thích hợp

        $data = $request->all();
        if (!isset($data['ratings'])) {
            return redirect()->back()->with('canhbao', 'Add at least one star rating for this Product');
        }
        $ratingCount = Rating::where(['users_id' => Auth::user()->id, 'products_id' => $data['products_id']])->count();
        if ($ratingCount > 0) {
            return redirect()->back()->with('canhbao', 'Your Rating is already exists for this Product');
        } else {
            $rating = new Rating;
            $rating->users_id = Auth::user()->id;
            $rating->products_id = $data['products_id'];
            $rating->ratings = $data['ratings'];
            $rating->content = $data['content'];
            $rating->save();
            return redirect()->back()->with('thongbao', 'Successfully');
        }
    }
    // khách (ko đăng nhập cũng có thể mua được)
    // Phương thức để hiển thị trang giỏ hàng
    // public function Getcart()
    // {
    //     // Hiển thị trang giỏ hàng
    //     // if (session()->has('cart')) {
    //     //     Cart::restore(session('cart'));
    //     // }

    //     return view('user.pages.product_cart');


    // }

    public function Getcart()
    {
        // Kiểm tra nếu session có thông tin giỏ hàng
        if(Auth::check()){
            if (Cookie::has('cart')) {
                // Lấy nội dung giỏ hàng từ cookie và giải mã JSON thành mảng
                $cartContent = json_decode(Cookie::get('cart'), true);
                // $userId = Auth::id();
                // print_r($userId);
                // echo "Dữ liệu trong \$cartContent: <pre>";
                // print_r($cartContent);
                // echo "</pre>";
                // Kiểm tra nếu có dữ liệu trong giỏ hàng
                if (!empty($cartContent)) {
                    // Cookie::forget('cart'); // Xóa cookie có tên là 'cart'
                    foreach ($cartContent as $item) {
                        // if($userId == $item['current_id']){
                        Cart::add($item['id'], $item['name'], $item['qty'], $item['price'], $item['weight'], [
                            'image' => $item['options']['image'],
                            'price_new' => $item['options']['price_new'],
                            'size' => $item['options']['size']
                        ]);
                        // }
                    }
                }
            }
        }
        return view('user.pages.product_cart');
    }

    public function Postcart(Request $request)
    {

        // Hiển thị trang giỏ hàng
        // echo ($request);
        // Cart::destroy();

        $products_id = $request->productid_hidden;
        $quantity = $request->qty;
        $products = Products::where('id', $products_id)->first();
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        if ($quantity >= $products['quantity']) {
            return redirect()->back()->with('canhbao', 'Vui lòng đặt hàng ít hơn số lượng: ' . $products['quantity'] . ' !!!');
        } else {

            // $userId = Auth::id();

            $data['id'] = $products_id;
            $data['qty'] = $quantity;
            $data['name'] = $products['name'];
            $data['price'] = $products['price'];
            $data['weight'] = 550;
            $data['options']['image'] = $products['image'];
            $data['options']['price_new'] = $products['price_new'];
            $data['options']['size'] = $products['size'];
            // $data['current_id'] = $userId;
            Cart::add($data);
            // Cart::destroy();
            Cart::setGlobalTax(0);
            if (Auth::check()) {
                // session()->put('cart', Cart::content());
                $cartContent = Cart::content();
                Cookie::queue('cart', $cartContent, 43200); // 30 ngày
            }
            // $cartContent = json_decode(Cookie::get('cart'), true);
            // echo "Dữ liệu trong \$cartContent: <pre>";
            // print_r($cartContent);
            // echo "</pre>";
        }

        return redirect('/cart')->with('thongbao', 'Sucessfully');
    }






    // Phương thức để lấy nội dung giỏ hàng
    public function index()
    {
        // Phương thức để lấy nội dung giỏ hàng
        return Cart::content();
    }

    // Phương thức để hiển thị trang thanh toán
    public function checkout()
    {
        // Hiển thị trang thanh toán
        if (Auth::check()) {
            $user = Auth::user();
            return view('user.pages.product_checkout', ['user' => $user]);
        } else {
            return view('user.pages.product_checkout', ['user' => 2]);
        }
    }
    // Phương thức để xóa mục khỏi giỏ hàng
    public function delete_cart($rowId)
    {
        // Xóa mục khỏi giỏ hàng
        Cart::update($rowId, 0);
        Orders_Detail::updated($rowId, 0);
        $cartContent = Cart::content();
        // Cookie::queue('cart', $cartContent, 43200); // Lưu giỏ hàng vào cookie
        Cookie::queue('cart', $cartContent, 43200); // Lưu giỏ hàng vào cookie
        return redirect('/cart')->with('thongbao', 'Sucessfully');
    }

    // Phương thức để cập nhật giỏ hàng // chưa đăng nhập
    public function update_cart(Request $request)
    {
        // Cập nhật giỏ hàng và chuyển hướng với thông báo thích hợp
        $rowId = $request->rowId_cart;
        $quantity = $request->cart_quantity;
        Cart::update($rowId, $quantity);
        $cartContent = Cart::content();
        // Cookie::queue('cart', $cartContent, 43200); // Lưu giỏ hàng vào cookie
        Cookie::queue('cart', $cartContent, 43200); // Lưu giỏ hàng vào cookie
        return redirect('/cart')->with('thongbao', 'Sucessfully');
    }
    public function clearCartManually()
    {
        $response = new Response(); // Tạo một đối tượng response mới

        // Đặt cookie mới với thời gian sống 0 để xóa cookie hiện tại
        $response->withCookie(cookie()->forget('cart'));

        return $response; // Trả về response
    }

    public function order_place(Request $request)
    {
        if (Auth::check()) {
         

            $content = Cart::content();
        
            $orders = array();
            $orders['users_id'] = Auth::user()->id;
            $orders['lastname'] = $request->lastname;
            $orders['firstname'] = $request->firstname;
            $orders['address'] = $request->address;
            $orders['district'] = $request->district;
            $orders['city'] = $request->city;
            $orders['phone'] = $request->phone;
            $orders['email'] = $request->email;
            $orders['content'] = $request->content;
            $orders['total'] = (int)preg_replace("/[,]+/", "", Cart::total(0));
            $orders['created_at'] =  now();
            // dd((int)preg_replace("/[,]+/", "", Cart::total(0)));
            $orders_id = Orders::insertGetId($orders);

            //insert order_details
            foreach ($content as $value) {
                $orders_detail['orders_id'] = $orders_id;
                $orders_detail['product_id'] = $value->id;
                $orders_detail['name'] = $value->name;
                $orders_detail['image'] = $value->options->image;
                $orders_detail['quantity'] = $value->qty;
                $orders_detail['price'] = $value->price;
                Orders_Detail::create($orders_detail);
                // Giảm số lượng sản phẩm trong bảng 'product'
                $product = Products::find($value->id);
                $product->quantity -= $value->qty;
                $product->save();
            }
            Cart::destroy();
            Cookie::queue(Cookie::forget('cart'));
            // session()->forget('cart');
            cookie()->forget('cart');
            return redirect('/your_orders')->with('thongbao', 'Successfully');
        } else {
            $content = Cart::content();
            //echo $content;
            //insert orders
            $orders = array();
            $orders['users_id'] = 2;
            $orders['lastname'] = $request->lastname;
            $orders['firstname'] = $request->firstname;
            $orders['address'] = $request->address;
            $orders['district'] = $request->district;
            $orders['city'] = $request->city;
            $orders['phone'] = $request->phone;
            $orders['email'] = $request->email;
            $orders['content'] = $request->content;
            $orders['total'] = (int)preg_replace("/[,]+/", "", Cart::total(0));
            $orders['created_at'] =  now();
            // dd((int)preg_replace("/[,]+/", "", Cart::total(0)));
            $orders_id = Orders::insertGetId($orders);

            //insert order_details
            foreach ($content as $value) {
                $orders_detail['orders_id'] = $orders_id;
                $orders_detail['product_id'] = $value->id;
                $orders_detail['name'] = $value->name;
                $orders_detail['image'] = $value->options->image;
                $orders_detail['quantity'] = $value->qty;
                $orders_detail['price'] = $value->price;
                Orders_Detail::create($orders_detail);
                // Giảm số lượng sản phẩm trong bảng 'product'
                $product = Products::find($value->id);
                $product->quantity -= $value->qty;
                $product->save();
            }
            Cart::destroy();
            Cookie::queue(Cookie::forget('cart'));
            // cookie()->forget('cart');
            return redirect('/your_orders')->with('thongbao', 'Successfully');
        }
    }
    //-------------------------------------------------------------------------------------------------------//
    // Phương thức để chỉnh sửa hình ảnh người dùng
    public function edit_img(Request $request)
    {
        // Chỉnh sửa hình ảnh người dùng và chuyển hướng với thông báo thích hợp
        $user = User::find(Auth::user()->id);
        if ($request->hasFile('Image')) {
            $file =  $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('/profile')->with('thongbao', 'Không hỗ trợ ' . $format);
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
            // $request['image'] = $img;
        }
        return redirect('profile')->with('thongbao', 'Update successfully!');
    }

    // Phương thức để chỉnh sửa hồ sơ người dùng
    public function edit_profile(Request $request)
    {
        // Chỉnh sửa hồ sơ người dùng và chuyển hướng với thông báo thích hợp
        $user = User::find(Auth::user()->id);
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
        // User::where('id',Auth::user()->id)->update($request->all());
        return redirect('/profile')->with('thongbao', 'Cập nhật thành công');
        // dd($user);
    }

    // Phương thức để hiển thị danh sách đơn hàng (chỉ có quản trị viên mới được truy cập)    
    public function orders_list()
    {
        // Hiển thị danh sách đơn hàng
        $orders = Orders::all();
        return view('admin.orders.list', ['orders' => $orders]);
    }
    public function orders_details($orders_id)
    {
        $orders_detail = Orders_Detail::where('orders_id', $orders_id)->get();
        return view('admin.orders.details', ['orders_detail' => $orders_detail]);
    }
    public function update(Request $request, $id)
    {
        Orders::find($id)->update($request->all());
        return redirect()->back()->with('thongbao', "Successfully");
    }
    public function your_orders()
    {
        if (Auth::check()) {
            $orders = Orders::all();
            return view('user.pages.orders', ['orders' => $orders]);
        } else {
            $orders = Orders::all();
            return view('user.pages.orders_no_login', ['orders' => $orders]);
        }
    }
    public function delete_orders($id)
    {
        // Tìm đơn hàng
        $order = Orders::find($id);

        if ($order) {
            // Lấy các chi tiết đơn hàng liên quan
            $orderDetails = Orders_Detail::where('orders_id', $id)->get();

            foreach ($orderDetails as $orderDetail) {
                // Tìm sản phẩm liên quan
                $product = Products::find($orderDetail->product_id);

                if ($product) {
                    // Tăng số lượng sản phẩm trong bảng product
                    $product->quantity += $orderDetail->quantity;
                    $product->save();
                }
            }
            // Xóa đơn hàng
            $order->delete($id);

            return response()->json(['success' => 'Delete Successfully']);
        } else {
            return response()->json(['error' => 'Order not found'], 404);
        }
    }
    public function your_orders_detail($id)
    {
        $orders_detail = Orders_Detail::where('orders_id', $id)->get();
        return view('user.pages.orders_detail', ['orders_detail' => $orders_detail]);
    }
    public function discount(Request $request)
    {
        $discounts = Discounts::all();
        foreach ($discounts as $value) {
            if ($value['code'] == $request->code) {
                if ($value['active'] == 1) {
                    $data = $value['discounts'];
                    Cart::setGlobalDiscount($data);
                    return redirect()->back()->with('thongbao', 'Apply Coupon Successfully');
                } else {
                    return redirect()->back()->with('canhbao', 'Code not available');
                }
            }
        }
        return redirect()->back()->with('canhbao', 'Wrong coupon code');
    }
    public function delete_discount()
    {
        Cart::setGlobalDiscount(0);
        return redirect()->back()->with('thongbao', 'Delete Coupon Successfully');
    }
}
