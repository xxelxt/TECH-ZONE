<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'vi'])) {
        abort('404');
    }
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'getlogin']);
    Route::post('/login', [AdminController::class, 'postlogin']);
    Route::get('/logout', [AdminController::class, 'getLogout']);
    Route::get('/profile', [AdminController::class, 'profile']);

    Route::post('/edit', [AdminController::class, 'edit_profile']);
    Route::post('/editimg', [AdminController::class, 'edit_img']);
    Route::post('/edit_facebook', [AdminController::class, 'edit_facebook']);
});

Route::prefix('admin')->middleware('admin', 'role:admin|staff')->group(function () {
    Route::get('/', [AdminController::class, 'home']);
    Route::prefix('staff')->group(function () {
        Route::get('/list', [AdminController::class, 'list'])->name('admin.staff.list');

        Route::get('/create', [AdminController::class, 'getcreate']);
        Route::post('/create', [AdminController::class, 'postcreate']);

        Route::get('/edit/{id}', [AdminController::class, 'getEdit']);
        Route::post('/edit/{id}', [AdminController::class, 'postEdit']);

        Route::get('/role/{id}', [AdminController::class, 'getrole']);
        Route::post('/role/{id}', [AdminController::class, 'postrole']);

        Route::get('/permission/{id}', [AdminController::class, 'getpermission']);
        Route::post('/permission/{id}', [AdminController::class, 'postpermission']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/list', [AdminController::class, 'userList'])->name('admin.users.list');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/list', [CategoriesController::class, 'list'])->name('admin.categories.list');

        Route::get('/create', [CategoriesController::class, 'getCreate']);
        Route::post('/create', [CategoriesController::class, 'postCreate']);

        Route::get('/edit/{id}', [CategoriesController::class, 'getEdit']);
        Route::post('/edit/{id}', [CategoriesController::class, 'postEdit']);
    });

    Route::prefix('subcategories')->group(function () {
        Route::get('/list', [SubCategoriesController::class, 'list'])->name('admin.subcategories.list');

        Route::get('/create', [SubCategoriesController::class, 'getCreate']);
        Route::post('/create', [SubCategoriesController::class, 'postCreate']);

        Route::get('/edit/{id}', [SubCategoriesController::class, 'getEdit']);
        Route::post('/edit/{id}', [SubCategoriesController::class, 'postEdit']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/list', [ProductsController::class, 'list'])->name('admin.products.list');

        Route::get('/create', [ProductsController::class, 'getCreate']);
        Route::post('/create', [ProductsController::class, 'postCreate']);

        Route::get('/edit/{id}', [ProductsController::class, 'getEdit']);
        Route::post('/edit/{id}', [ProductsController::class, 'postEdit']);
    });

    Route::prefix('brands')->group(function () {
        Route::get('/list', [BrandsController::class, 'list'])->name('admin.brands.list');

        Route::get('/create', [BrandsController::class, 'getCreate']);
        Route::post('/create', [BrandsController::class, 'postCreate']);

        Route::get('/edit/{id}', [BrandsController::class, 'getEdit']);
        Route::post('/edit/{id}', [BrandsController::class, 'postEdit']);

        Route::get('/delete/{id}', [BrandsController::class, 'Delete']);
    });

    Route::prefix('discounts')->group(function () {
        Route::get('/list', [DiscountsController::class, 'list'])->name('admin.discounts.list');

        Route::get('/create', [DiscountsController::class, 'getCreate']);
        Route::post('/create', [DiscountsController::class, 'postCreate']);

        Route::get('/edit/{id}', [DiscountsController::class, 'getEdit']);
        Route::post('/edit/{id}', [DiscountsController::class, 'postEdit']);

        Route::get('/delete/{id}', [DiscountsController::class, 'Delete']);
    });

    Route::prefix('banners')->group(function () {
        Route::get('/list', [BannersController::class, 'list']);

        Route::get('/create', [BannersController::class, 'getCreate']);
        Route::post('/create', [BannersController::class, 'postCreate']);

        Route::get('/edit/{id}', [BannersController::class, 'getEdit']);
        Route::post('/edit/{id}', [BannersController::class, 'postEdit']);

        Route::get('/delete/{id}', [BannersController::class, 'getDelete']);
    });

    Route::prefix('about')->group(function () {
        Route::get('/', [AboutController::class, 'getEdit']);
        Route::post('/', [AboutController::class, 'postEdit']);
    });

    Route::prefix('rating')->group(function () {
        Route::get('/', [AdminController::class, 'getRating'])->name('admin.ratings.list');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/list', [RolesController::class, 'list']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/list', [AdminController::class, 'orders_list'])->name('admin.orders.list');
        Route::get('/details/{orders_id}', [AdminController::class, 'orders_details']);
        Route::post('/update/{id}', [AdminController::class, 'update']);
    });
});

Route::get('ajax/Subcategories/{cat_id}', [AjaxController::class, 'getSub']);
Route::get('ajax/active_cate', [AjaxController::class, 'Categories']);
Route::get('ajax/active_sub', [AjaxController::class, 'Subcategories']);
Route::get('ajax/active_brand', [AjaxController::class, 'Brands']);
Route::get('ajax/active_product', [AjaxController::class, 'Products']);
Route::get('ajax/active_featured_product', [AjaxController::class, 'Featured_Products']);
Route::get('ajax/active_staff', [AjaxController::class, 'Staff']);
Route::get('ajax/active_user', [AjaxController::class, 'Users']);
Route::get('ajax/active_discount', [AjaxController::class, 'Discounts']);
Route::get('ajax/active_banners', [AjaxController::class, 'Banners']);

Route::delete('ajax/delete_categories/{id}', [CategoriesController::class, 'delete_categories']);
Route::delete('ajax/deleteall_categories', [CategoriesController::class, 'deleteall_categories']);
Route::delete('ajax/delete_subcategories/{id}', [SubCategoriesController::class, 'delete_subcategories']);
Route::delete('ajax/deleteall_subcategories', [SubCategoriesController::class, 'deleteall_subcategories']);
Route::delete('ajax/delete_brands/{id}', [BrandsController::class, 'delete_brands']);
Route::delete('ajax/deleteall_brands', [BrandsController::class, 'deleteall_brands']);
Route::delete('ajax/delete_discounts/{id}', [DiscountsController::class, 'delete_discounts']);
Route::delete('ajax/deleteall_discounts', [DiscountsController::class, 'deleteall_discounts']);
Route::delete('ajax/delete_banners/{id}', [BannersController::class, 'delete_banners']);
Route::delete('ajax/deleteall_banners', [BannersController::class, 'deleteall_banners']);
Route::delete('ajax/delete_rating/{id}', [UserController::class, 'delete_rating']);
Route::delete('ajax/delete_staff/{id}', [UserController::class, 'delete_staff']);
Route::delete('ajax/delete_products/{id}', [ProductsController::class, 'delete_products']);
Route::delete('ajax/deleteimages/{id}', [ProductsController::class, 'Deleteimages']);

Route::delete('ajax/delete_orders/{id}', [AdminController::class, 'delete_orders']);

Route::get('/', [UserController::class, 'home'])->name('user.home');
Route::get('/register', [UserController::class, 'get_register']);
Route::post('/register', [UserController::class, 'post_register']);
Route::get('/login', [UserController::class, 'get_login']);
Route::post('/login', [UserController::class, 'post_login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/profile', [UserController::class, 'profile']);
Route::post('/addRating', [UserController::class, 'addRating']);
Route::post('/editimg_user', [UserController::class, 'edit_img']);
Route::post('/edit_profile', [UserController::class, 'edit_profile']);

Route::post('/wishlist', [UserController::class, 'wishlist']);
Route::get('/total_wishlist', [UserController::class, 'total_wishlist']);

Route::get('/product_featured_all', [UserController::class, 'product_featured_all']);
Route::get('/product_latest_all', [UserController::class, 'product_latest_all']);
Route::get('/product_sale_all', [UserController::class, 'product_sale_all']);
Route::get('/all_products', [UserController::class, 'product_all']);

Route::get('/search', [UserController::class, 'search_user']);
Route::get('/brands/{id}', [UserController::class, 'product_brand']);
Route::get('/products/{id}', [UserController::class, 'product_details']);
Route::get('/categories/{id}', [UserController::class, 'product_grid']);
Route::get('/subcategories/{id}', [UserController::class, 'product_grid_sub']);

Route::post('/wishlist', [UserController::class, 'wishlist']);
Route::get('/total_wishlist', [UserController::class, 'total_wishlist']);
Route::get('/wishlist_pages', [UserController::class, 'wishlist_pages']);

Route::get('/cart', [UserController::class, 'Getcart'])->name('cart');
Route::post('/cart', [UserController::class, 'Postcart']);
Route::post('/cart/add', [UserController::class, 'Postcart']);
Route::get('/delete_cart/{rowId}', [UserController::class, 'delete_cart']);
Route::post('/update_cart', [UserController::class, 'update_cart']);

Route::post('/discount', [UserController::class, 'discount']);
Route::post('/delete_discount', [UserController::class, 'delete_discount']);
Route::get('/checkout', [UserController::class, 'checkout']);
Route::post('/order_place', [UserController::class, 'order_place'])->name('order_place');

Route::get('/check-cart-cookie', 'CartController@checkCartCookie');
Route::get('/your_orders', [UserController::class, 'your_orders']);
Route::get('/your_orders_detail/{id}', [UserController::class, 'your_orders_detail'])->name('your_orders_detail');

Route::post('/vnpay_payment', [UserController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay_check', [UserController::class, 'vnpay_check'])->name('vnpay.check');

Route::post('/momo_payment', [UserController::class, 'momo_payment'])->name('momo_payment');
Route::get('/momo_check', [UserController::class, 'momo_check'])->name('momo.check');

Route::get('/forgetpassword', [UserController::class, 'forgetpassword']);
Route::get('/update-new-pass', [UserController::class, 'update_new_pass']);

Route::post('/send_email', [UserController::class, 'send_passreset_token']);
Route::post('/solve-update-new-pass', [UserController::class, 'solve_update_new_pass']);
Route::get('/give_mail_your_order/{id}', [UserController::class, 'give_mail_your_order']);
