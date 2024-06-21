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
use Carbon\Carbon;

class UserController extends Controller
{
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

    public function home()
    {
        return view('user.pages.home');
    }

    public function get_login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('user.login');
    }

    public function get_register()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('user.register');
    }

    public function forgetpassword()
    {
        $about = About::first();
        if (Auth::check()) {
            return redirect('/');
        }
        return view('user.forgetpassword');
    }

    public function update_new_pass()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('user.update_new_pass');
    }

    // Xử lý việc đăng ký tài khoản mới
    public function post_register(Request $request)
    {
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

        return redirect('login')->with('thongbao', __('lang.sign_up_success'));
    }

    // Xử lý việc đăng nhập tài khoản
    public function post_login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ], [
            'login.required' => 'Vui lòng nhập email hoặc tên người dùng',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);

        $login = $request->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $login, 'password' => $request->password])) {
            // Cookie::queue(Cookie::forget('cart'));
            return redirect('/');
        } else {
            return redirect('/login')->with('canhbao', __('lang.failed_login'));
        }
    }

    // Xử lý đăng xuất tài khoản
    public function logout()
    {
        Auth::logout();
        Cart::destroy();
        return redirect('/');
    }

    // Hiển thị trang hồ sơ tài khoản
    public function profile()
    {
        if (Auth::check()) {
            $user = Auth()->user();
        } else {
            return redirect('/login');
        }

        return view('user.profile', ['user' => $user]);
    }

    public function delete_staff($id)
    {
        $user = User::find($id);

        if ($user['active'] == 0) {
            if ($user->hasRole('admin')) {
                return response()->json(['error' => __('lang.cant_delete_admin')]);
            } else {
                $user->delete($id);

                if ($user['image'] != 'avatar.jpg') {
                    File::delete('upload/avatar/' . $user['image']);
                }

                return response()->json(['success' => __('lang.delete_success')]);
            }
        } else {
            return response()->json(['error' => __('lang.cant_delete_active')]);
        }
    }

    public function delete_rating($id)
    {
        $rating = Rating::find($id);
        $rating->delete($id);
        return response()->json(['success' => __('lang.delete_success')]);
    }

    public function product_details($id)
    {
        $pro = Products::all();
        $products = Products::find($id);

        $related_products = Products::where('active', 1)
            ->where('categories_id', $products['categories_id'])
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $wishlist = new Wishlist;
        $countWishlist = $wishlist->countWishlist($products['id']);
        $ratings = Rating::where('products_id', $id)->orderBy('id', 'DESC')->get();

        return view('user.pages.product_details', [
            'products' => $products,
            'related_products' => $related_products, 'countWishlist' => $countWishlist,
            'pro' => $pro, 'ratings' => $ratings
        ]);
    }

    public function product_all(Request $request)
    {
        $categories = Categories::all();
        $wishlist = new Wishlist;

        $query = Products::where('active', 1);

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        $search = $query->paginate(15);
        $count = $search->total();

        return view('user.pages.product_all', [
            'categories' => $categories,
            'search'     => $search,
            'count'      => $count,
            'wishlist'   => $wishlist,
        ]);
    }

    // Hiển thị sản phẩm theo danh mục
    public function product_grid($id)
    {
        $danhmuc = Categories::find($id);
        $categories = Categories::all();

        $query = Products::where('active', 1)->where('categories_id', $id)->orderBy('id', 'DESC');

        if (request('sort') == 'price_asc') {
            $query->orderBy('price', 'ASC');
        } elseif (request('sort') == 'price_desc') {
            $query->orderBy('price', 'DESC');
        } elseif (request('sort') == 'name_asc') {
            $query->orderBy('name', 'ASC');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'DESC');
        } else {
            $query->orderBy('id', 'ASC');
        }

        $products = $query->paginate(15);
        $count = $products->total();

        $wishlist = new Wishlist;

        return view('user.pages.product_grid', [
            'danhmuc' => $danhmuc,
            'categories' => $categories,
            'products' => $products,
            'count' => $count,
            'wishlist' => $wishlist
        ]);
    }

    // Hiển thị sản phẩm theo danh mục con
    public function product_grid_sub($id)
    {
        $danhmuc = SubCategories::find($id);
        $categories = Categories::all();

        $query = Products::where('active', 1)->where('sub_id', $id)->orderBy('id', 'DESC');

        if (request('sort') == 'price_asc') {
            $query->orderBy('price', 'ASC');
        } elseif (request('sort') == 'price_desc') {
            $query->orderBy('price', 'DESC');
        } elseif (request('sort') == 'name_asc') {
            $query->orderBy('name', 'ASC');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'DESC');
        } else {
            $query->orderBy('id', 'ASC');
        }

        $products = $query->paginate(15);
        $count = $products->total();

        $wishlist = new Wishlist;

        return view('user.pages.product_grid_sub', [
            'danhmuc' => $danhmuc,
            'categories' => $categories,
            'products' => $products,
            'count' => $count,
            'wishlist' => $wishlist
        ]);
    }

    // Hiển thị sản phẩm mới nhất
    public function product_latest_all()
    {
        $categories = Categories::all();

        $query = Products::where('active', 1);

        if (request('sort') == 'price_asc') {
            $query->orderBy('price', 'ASC');
        } elseif (request('sort') == 'price_desc') {
            $query->orderBy('price', 'DESC');
        } elseif (request('sort') == 'name_asc') {
            $query->orderBy('name', 'ASC');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'DESC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        $products = $query->paginate(15);
        $count = $products->total();

        return view('user.pages.product_latest_all', ['products' => $products, 'categories' => $categories, 'count' => $count]);
    }

    // Hiển thị sản phẩm đang giảm giá
    public function product_sale_all()
    {
        $categories = Categories::all();

        $query = Products::where('active', 1)->whereNotNull('price_new'); // Chỉ lấy sản phẩm có giá sale

        if (request('sort') == 'price_asc') {
            $query->orderBy('price_new', 'ASC'); // Sắp xếp theo giá sale
        } elseif (request('sort') == 'price_desc') {
            $query->orderBy('price_new', 'DESC'); // Sắp xếp theo giá sale
        } elseif (request('sort') == 'name_asc') {
            $query->orderBy('name', 'ASC');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $products = $query->paginate(15);
        $count = $products->total();

        return view('user.pages.product_sale_all', ['count' => $count, 'products' => $products, 'categories' => $categories]);
    }

    public function product_featured_all()
    {
        $categories = Categories::all();

        $query = Products::where('active', 1)->where('featured_product', 1);

        if (request('sort') == 'price_asc') {
            $query->orderBy('price', 'ASC');
        } elseif (request('sort') == 'price_desc') {
            $query->orderBy('price', 'DESC');
        } elseif (request('sort') == 'name_asc') {
            $query->orderBy('name', 'ASC');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $products = $query->paginate(15);
        $count = $products->total();

        return view('user.pages.product_featured_all', ['products' => $products, 'categories' => $categories, 'count' => $count]);
    }

    public function product_brand($id)
    {
        $danhmuc = Brands::find($id);
        $categories = Categories::all();
        $wishlist = new Wishlist;

        $query = Products::where('active', 1)->where('brands_id', $id);

        if (request('sort') == 'price_asc') {
            $query->orderBy('price', 'ASC');
        } elseif (request('sort') == 'price_desc') {
            $query->orderBy('price', 'DESC');
        } elseif (request('sort') == 'name_asc') {
            $query->orderBy('name', 'ASC');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $products = $query->paginate(15);
        $count = $products->total();

        return view('user.pages.product_brand', [
            'categories' => $categories,
            'danhmuc' => $danhmuc,
            'products' => $products,
            'count' => $count,
            'wishlist' => $wishlist
        ]);
    }

    // Xử lý tìm kiếm sản phẩm
    public function search_user(Request $request)
    {
        if ($request['search']) {
            $categories = Categories::all();
            $search = Products::where('active', 1)->where('name', 'LIKE', '%' . $request['search'] . '%')->latest()->Paginate(15);
            $count = count($search);
            return view('user.pages.product_all', ['categories' => $categories, 'search' => $search, 'count' => $count]);
        } else {
            return redirect()->back()->with('canhbao', __('lang.empty_search'));
        }
    }

    // Xử lý thêm/ xoá danh sách yêu thích với JSON
    public function wishlist(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $wishlist = new Wishlist;
            $countWishlist = $wishlist->countWishlist($data['products_id']);

            if ($countWishlist == 0) {
                $wishlist->products_id = $data['products_id'];
                $wishlist->users_id = $data['users_id'];
                $wishlist->save();

                return response()->json(['action' => 'add', 'message' => __('lang.wishlist_added')]);
            } else {
                Wishlist::where(['users_id' => Auth::user()->id, 'products_id' => $data['products_id']])->delete();
                return response()->json(['action' => 'remove', 'message' => __('lang.wishlist_removed')]);
            }
        }
    }

    // Tổng số sản phẩm yêu thích
    public function total_wishlist()
    {
        $total_wishlist = Wishlist::where(['users_id' => Auth::user()->id])->count();
        echo json_encode($total_wishlist);
    }

    // Hiển thị trang yêu thích
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

    // Xử lý thêm đánh giá sản phẩm
    public function addRating(Request $request)
    {
        $data = $request->all();
        if (!isset($data['rating_value'])) {
            return redirect()->back()->with('canhbao', __('lang.empty_rating'));
        }

        $ratingCount = Rating::where(['users_id' => Auth::user()->id, 'products_id' => $data['products_id']])->count();

        if ($ratingCount > 0) {
            return redirect()->back()->with('canhbao', __('lang.existed_rating'));
        } else {
            $rating = new Rating;
            $rating->users_id = Auth::user()->id;
            $rating->products_id = $data['products_id'];
            $rating->ratings = $data['rating_value'];
            $rating->content = $data['content'];
            $rating->save();

            return redirect()->back()->with('thongbao', __('lang.rating_success'));
        }
    }

    // Lấy nội dung giỏ hàng
    public function index()
    {
        return Cart::content();
    }

    public function Getcart()
    {
        // Kiểm tra nếu session có thông tin giỏ hàng
        if (Auth::check()) {
            if (Cookie::has('cart')) {
                // Lấy nội dung giỏ hàng từ cookie và giải mã JSON thành mảng
                $cartContent = json_decode(Cookie::get('cart'), true);

                // Kiểm tra nếu có dữ liệu trong giỏ hàng
                if (!empty($cartContent)) {
                    Cart::destroy(); // Xóa giỏ hàng hiện tại

                    foreach ($cartContent as $item) {
                        Cart::add($item['id'], $item['name'], $item['qty'], $item['price'], $item['weight'], [
                            'image' => $item['options']['image'],
                            'price_new' => $item['options']['price_new'],
                            'size' => $item['options']['size']
                        ]);
                    }
                }
            }
        }

        Cart::setGlobalTax(0);

        return view('user.pages.product_cart');
    }

    public function Postcart(Request $request)
    {
        $products_id = $request->productid_hidden;
        $quantity = $request->qty;
        $products = Products::where('id', $products_id)->first();

        if ($quantity >= $products['quantity']) {
            return redirect()->back()->with('canhbao', __('lang.order_less_than') . $products['quantity']);
        } else {

            $data['id'] = $products_id;
            $data['qty'] = $quantity;
            $data['name'] = $products['name'];
            $data['price'] = $products['price'];
            $data['weight'] = 550;
            $data['options']['image'] = $products['image'];
            $data['options']['price_new'] = $products['price_new'];
            $data['options']['size'] = $products['size'];

            Cart::add($data);
            Cart::setGlobalTax(0);

            if (Auth::check()) {
                $cartContent = Cart::content();
                Cookie::queue('cart', $cartContent, 43200);
            }
        }

        return redirect('/cart')->with('thongbao', 'Sucessfully');
    }

    // Xoá mục khỏi giỏ hàng
    public function delete_cart($rowId)
    {
        Cart::update($rowId, 0);
        Orders_Detail::updated($rowId, 0);

        $cartContent = Cart::content();
        Cookie::queue('cart', $cartContent, 43200); // Lưu giỏ hàng vào cookie

        return redirect('/cart')->with('thongbao', __('lang.delete_cart_item'));
    }

    // Cập nhật giỏ hàng
    public function update_cart(Request $request)
    {
        $rowId = $request->rowId_cart;
        $quantity = $request->cart_quantity;

        Cart::update($rowId, $quantity);
        $cartContent = Cart::content();

        Cookie::queue('cart', $cartContent, 43200); // Lưu giỏ hàng vào cookie
        return redirect('/cart')->with('thongbao', __('lang.update_cart_item'));
    }

    public function order_place(Request $request)
    {
        if (Auth::check()) {

            $content = Cart::content();

            // Orders
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
            $orders_id = Orders::insertGetId($orders);

            // Order details
            foreach ($content as $value) {
                $orders_detail['orders_id'] = $orders_id;
                $orders_detail['product_id'] = $value->id;
                $orders_detail['name'] = $value->name;
                $orders_detail['image'] = $value->options->image;
                $orders_detail['quantity'] = $value->qty;
                $orders_detail['price'] = $value->price;
                Orders_Detail::create($orders_detail);

                // Cập nhật số lượng trong bảng products
                $product = Products::find($value->id);
                $product->quantity -= $value->qty;
                $product->save();
            }

            Cart::destroy();
            Cookie::queue(Cookie::forget('cart'));

            cookie()->forget('cart');
            return redirect('/give_mail_your_order/' . $orders_id)->with('thongbao', __('lang.order_success') . $orders_id);
        } else {
            $content = Cart::content();

            // Orders
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
            $orders_id = Orders::insertGetId($orders);

            // Order details
            foreach ($content as $value) {
                $orders_detail['orders_id'] = $orders_id;
                $orders_detail['product_id'] = $value->id;
                $orders_detail['name'] = $value->name;
                $orders_detail['image'] = $value->options->image;
                $orders_detail['quantity'] = $value->qty;
                $orders_detail['price'] = $value->price;
                Orders_Detail::create($orders_detail);

                // Cập nhật số lượng trong bảng products
                $product = Products::find($value->id);
                $product->quantity -= $value->qty;
                $product->save();
            }

            Cart::destroy();
            Cookie::queue(Cookie::forget('cart'));

            return redirect('/give_mail_your_order/' . $orders_id)->with('thongbao', __('lang.order_success') . $orders_id);
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user.pages.product_checkout', ['user' => $user]);
        } else {
            return view('user.pages.product_checkout', ['user' => 2]);
        }
    }

    public function discount(Request $request)
    {
        $discounts = Discounts::all();
    
        foreach ($discounts as $value) {
            if ($value->code == $request->code) {
                if ($value->active == 1) {
                    $data = $value->discounts;
                    Cart::setGlobalDiscount($data);
    
                    // Lưu mã giảm giá vào session
                    $request->session()->put('discount_code', $value->code);
    
                    // Giảm số lượng phiếu giảm giá trong cơ sở dữ liệu
                    $value->quantity--;
                    $value->save();
    
                    return redirect()->back()->with('thongbao', __('lang.coupon_success'));
                } else {
                    return redirect()->back()->with('canhbao', __('lang.coupon_notavail'));
                }
            }
        }
    
        return redirect()->back()->with('canhbao', __('lang.coupon_notavail'));
    }
    

    // Xoá mã giảm giá khỏi đơn hàng
    public function delete_discount(Request $request)
    {
        // Lấy mã giảm giá từ session
        $discountCode = $request->session()->get('discount_code');
    
        // Xóa mã giảm giá khỏi session
        $request->session()->forget('discount_code');
    
        // Tăng số lượng phiếu giảm giá trong cơ sở dữ liệu
        $discount = Discounts::where('code', $discountCode)->first();
        if ($discount) {
            $discount->quantity++;
            $discount->save();
    
            // Xóa giảm giá toàn cầu trong giỏ hàng
            Cart::setGlobalDiscount(0);
    
            return redirect()->back()->with('thongbao', __('lang.delete_coupon_noti'));
        }
    
        return redirect()->back()->with('canhbao', __('lang.coupon_notavail'));
    }
    

    // Cập nhật hình ảnh tài khoản
    public function edit_img(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->hasFile('Image')) {

            $file =  $request->file('Image');
            $format = $file->getClientOriginalExtension();

            if ($format != 'jpg' && $format != 'jpeg' && $format != 'png') {
                return redirect('/profile')->with('thongbao', __('lang.unsupported_file') . $format);
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

        return redirect('profile')->with('thongbao', __('lang.update_successful'));
    }

    // Cập nhật profile tài khoản
    public function edit_profile(Request $request)
    {
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

        return redirect('/profile')->with('thongbao', __('lang.update_successful'));
    }

    // Trang lịch sử đặt hàng (của người dùng)
    public function your_orders(Request $request)
    {
        if (Auth::check()) {
            $query = Orders::where('users_id', Auth::id());

            if ($request->filled('sort')) {
                $sort = $request->input('sort');
                $query->where('status', $sort);
            }

            if ($request->has('query')) {
                $searchQuery = $request->input('query');
                $query->where(function ($subQuery) use ($searchQuery) {
                    $subQuery->where('id', 'LIKE', "%$searchQuery%")
                        ->orWhere('lastname', 'LIKE', "%$searchQuery%")
                        ->orWhere('firstname', 'LIKE', "%$searchQuery%")
                        ->orWhere('phone', 'LIKE', "%$searchQuery%")
                        ->orWhere('address', 'LIKE', "%$searchQuery%")
                        ->orWhere('district', 'LIKE', "%$searchQuery%")
                        ->orWhere('city', 'LIKE', "%$searchQuery%")
                        ->orWhere('content', 'LIKE', "%$searchQuery%");
                });
            }

            $orders = $query->get();

            return view('user.pages.orders', ['orders' => $orders]);
        } else {
            return redirect()->route('user.home');
        }
    }

    public function your_orders_detail($id)
    {
        $order = Orders::findOrFail($id);
        $orders_detail = Orders_Detail::where('orders_id', $id)->get();

        if (Auth::check() && $order->users_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('user.pages.orders_detail', [
            'order' => $order,
            'orders_detail' => $orders_detail
        ]);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );

        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    // Thanh toán MoMo (ATM)
    public function momo_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";

        $cartContent = Cart::content();
        $amount = Cart::total(0, '', '');
        $orderId = uniqid();

        $redirectUrl = route('momo.check');
        $ipnUrl = route('momo.check');
        $requestId = uniqid();
        $requestType = "payWithATM";
        $extraData = "";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $cartContent = Cart::content()->toJson(); // Chuyển nội dung giỏ hàng thành JSON
        Cookie::queue('cart_backup', $cartContent, 43200);

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        $this->order_place($request);
        return redirect($jsonResult['payUrl']);
    }

    // Kiểm tra thanh toán MoMo
    public function momo_check(Request $request)
    {
        $resultCode = $request->get('resultCode');
        $latestOrder = Orders::orderBy('created_at', 'desc')->first(); // Tìm đơn hàng mới nhất
        $orderId = $latestOrder->id; // Lấy ID của đơn hàng mới nhất

        if ($resultCode === '0') { // Success
            $this->handleMomoSuccess($orderId);
            return redirect('/give_mail_your_order/' . $orderId)->with('thongbao', __('lang.pay_success') . $orderId);
        } else {
            $this->handleMomoFailure($orderId);
            return redirect()->route('cart')->with('canhbao', __('lang.pay_failed'));
        }
    }

    // Thanh toán MoMo thành công
    private function handleMomoSuccess($orderId)
    {
        $order = Orders::find($orderId);

        if ($order) {
            $order->payment_status = 2;
            $order->save();

            Cart::destroy();
            Cookie::queue(Cookie::forget('cart'));
            session()->forget('cart');
        }
    }

    // Thanh toán MoMo thất bại
    private function handleMomoFailure($orderId)
    {
        $order = Orders::find($orderId);

        if ($order) {
            $orderDetails = Orders_Detail::where('orders_id', $orderId)->get();
            foreach ($orderDetails as $orderDetail) {
                $product = Products::find($orderDetail->product_id);
                if ($product) {
                    $product->quantity += $orderDetail->quantity;
                    $product->save();
                }
            }

            $order->delete();
        } else {
            if (Cookie::has('cart_backup')) {
                $cartContent = json_decode(Cookie::get('cart_backup'), true);
                Cart::destroy();

                foreach ($cartContent as $item) {
                    Cart::add($item['id'], $item['name'], $item['qty'], $item['price'], 0, $item['options']);
                }

                Cookie::queue(Cookie::forget('cart_backup'));
            }
        }
    }

    // Thanh toán VNPAY (ATM)
    public function vnpay_payment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.check');
        $vnp_TmnCode = "0YKCXJ3P"; // Mã website tại VNPAY 
        $vnp_HashSecret = "2YV8L7KX9HRPTBF2YNXMSAEIBZE6BO2R";

        $cartContent = Cart::content();

        $vnp_TxnRef = uniqid(); // Lấy ID của đơn hàng mới nhất
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_OrderType = "billpayment";

        $vnp_Amount = Cart::total(0, '', '') * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );

        $cartContent = Cart::content()->toJson(); // Chuyển nội dung giỏ hàng thành JSON
        Cookie::queue('cart_backup', $cartContent, 43200);

        if (isset($_POST['redirect'])) {
            $this->order_place($request);
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData); // Initial request, not a response from VNPay
        }
    }

    // Kiểm tra thanh toán VNPAY
    public function vnpay_check(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $latestOrder = Orders::orderBy('created_at', 'desc')->first(); // Tìm đơn hàng mới nhất
        $orderId = $latestOrder->id;

        if ($vnp_ResponseCode === '00') { // Success
            $this->handleVnpaySuccess($orderId);
            return redirect('/give_mail_your_order/' . $orderId)->with('thongbao', __('lang.pay_success') . $orderId);
        } else {
            $this->handleVnpayFailure($orderId);
            return redirect()->route('cart')->with('canhbao', __('lang.pay_failed'));
        }
    }

    // Thanh toán VNPAY thành công
    private function handleVnpaySuccess($orderId)
    {
        $order = Orders::find($orderId);

        if ($order) {
            $order->payment_status = 2;
            $order->save();

            Cart::destroy();
            Cookie::queue(Cookie::forget('cart'));
            session()->forget('cart');
        }
    }

    // Thanh toán VNPAY thất bại
    private function handleVnpayFailure($orderId)
    {
        $order = Orders::find($orderId);

        if ($order) {
            $orderDetails = Orders_Detail::where('orders_id', $orderId)->get();
            foreach ($orderDetails as $orderDetail) {
                $product = Products::find($orderDetail->product_id);
                if ($product) {
                    $product->quantity += $orderDetail->quantity;
                    $product->save();
                }
            }

            $order->delete();
        } else {
            if (Cookie::has('cart_backup')) {
                $cartContent = json_decode(Cookie::get('cart_backup'), true);
                Cart::destroy();

                foreach ($cartContent as $item) {
                    Cart::add($item['id'], $item['name'], $item['qty'], $item['price'], 0, $item['options']);
                }
                Cookie::queue(Cookie::forget('cart_backup'));
            }
        }
    }

    // Gửi token đặt lại mật khẩu
    public function send_passreset_token(Request $request)
    {
        $data = $request->all();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title = '[TechZone] Lấy lại mật khẩu / Password retrieval';

        $user = User::where('email', '=', $data['gmail'])->get();
        print_r($data['gmail']);
        foreach ($user as $key => $value) {
            $user_id = $value->id;
        }
        if ($user) {
            $count = $user->count();
            print_r($count);
            if ($count == 0) {
                return redirect()->back()->with('error', __('lang.email_notexist'));
            } else {
                $token_random = Str::random(191);
                $user = User::find($user_id);
                $user->reset_token = $token_random;
                $user->save();

                // Send email
                $to_email = $data['gmail'];
                $link_reset_pass = url('/update-new-pass?email=' . $to_email . '&token=' . $token_random);
                $mail_data = [
                    "name" => $title,
                    "body" => $link_reset_pass,
                    'email' => $to_email
                ];

                Mail::send('user.forget_notify', ['data' => $mail_data], function ($message) use ($title, $mail_data) {
                    $message->to($mail_data['email'])->subject($title);
                    $message->from('no-reply@yourdomain.com', 'Your Application Name');
                });
            }

            return redirect()->back()->with('thongbao', __('lang.pass_email_sent'));
        }
    }

    // Xử lý đặt lại mật khẩu
    public function solve_update_new_pass(Request $request)
    {
        $data = $request->all();
        $gmail = $data['gmail'];
        $token = $data['token'];
        $token_random = Str::random(191);

        $newPassword = $data['newpass'];
        $newPasswordConfirmation = $data['newpass_confirmation']; // Lấy giá trị xác nhận mật khẩu

        if ($newPassword !== $newPasswordConfirmation) {
            return redirect()->back()->with('', __('lang.password_not_match'));
        }

        $user = User::where('email', '=', $gmail)->where('reset_token', '=', $token)->get();
        $count = $user->count();
        if ($count == 1) {

            foreach ($user as $key => $value) {
                $user_id = $value->id;
            }
            $reset = User::find($user_id);
            $reset->password = bcrypt($newPassword);
            $reset->reset_token = $token_random;
            $reset->save();

            return redirect('/login')->with("success", __('lang.update_successs'));
        } else {
            return redirect('/forgetpassword')->with("error", 'Request Timeout!');
        }
    }

    // Gửi email sau khi đặt hàng thành công
    public function give_mail_your_order($id)
    {

        if (Auth::check()) {
            $orders_id = $id;

            Cart::destroy();
            $content = Orders::find($orders_id);

            $title = '[TechZone] Xác nhận đơn hàng mã #' . $orders_id;

            $to_email = $content['email'];
            $link_order = url('/your_orders_detail/' . $id);
            $orders_detail = Orders_Detail::where('orders_id', $orders_id)->get();

            $mail_data = [
                "name" => $title,
                "body" => $link_order,
                'email' => $to_email,
                'order' => $content,
                'orders_detail' => $orders_detail
            ];

            Mail::send('user.order_mail', [
                'order' => $content,
                'orders_detail' => $orders_detail,
                'body' => $link_order
            ], function ($message) use ($title, $mail_data) {
                $message->to($mail_data['email'])->subject($title);
                $message->from('hi@techzone.io', 'TechZone');
            });

            return redirect('/your_orders_detail/' . $id)->with('thongbao', __('lang.order_success'));
        } else {

            $orders_id = $id;

            Cart::destroy();
            $content = Orders::find($orders_id);

            $title = '[TechZone] Xác nhận đơn hàng mã #' . $orders_id;

            $to_email = $content['email'];
            $link_order = url('/your_orders_detail/' . $id);
            $orders_detail = Orders_Detail::where('orders_id', $orders_id)->get();

            $mail_data = [
                "name" => $title,
                "body" => $link_order,
                'email' => $to_email,
                'order' => $content,
                'orders_detail' => $orders_detail
            ];

            Mail::send('user.order_mail', [
                'order' => $content,
                'orders_detail' => $orders_detail,
                'body' => $link_order
            ], function ($message) use ($title, $mail_data) {
                $message->to($mail_data['email'])->subject($title);
                $message->from('hi@techzone.io', 'TechZone');
            });

            return redirect('/your_orders_detail/' . $id)->with('thongbao', __('lang.order_success'));
        }
    }
}
