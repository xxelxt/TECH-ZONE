@include('user.layout.product_sale')
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <a href="/product_featured_all">
                        <h2>@lang('lang.featured_product')</h2>
                    </a>
                </div>
                <div class="featured__controls">

                </div>
            </div>
        </div>
        <div class="categories__slider owl-carousel">
            @foreach($products as $pro) <!-- Lặp qua từng sản phẩm trong mảng $products -->
            @if($pro['featured_product'] == 1) <!-- Kiểm tra nếu sản phẩm là sản phẩm nổi bật -->
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                <div class="featured__item__pic set-bg">
                        <a href="{{ url('products/'.$pro['id']) }}">
                            <img src="user_asset/images/products/{!! $pro['image'] !!}" alt="{!! $pro['name'] !!}" class="product-image">
                        </a>
                        <!-- Đặt hình nền cho sản phẩm bằng hình ảnh từ dữ liệu -->
                        <!-- <img src="user_asset/images/products/{!! $pro['image'] !!}" alt=""> -->
                        <ul class="featured__item__pic__hover">
                            <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                            @if(Auth::check())
                            @php
                            //Đếm số lượng wishlist của sản phẩm
                            $countWishlist = $wishlist->countWishlist($pro['id']);
                            @endphp
                            <li><a href="javascript:void(0)" data-productid="{!! $pro['id'] !!}" class="wishlist">
                                    @if($countWishlist > 0) <!-- Kiểm tra nếu sản phẩm đã có trong wishlist -->
                                    <i class="fas fa-heart"></i> <!-- Hiển thị biểu tượng trái tim đầy -->
                                    @else
                                    <i class="far fa-heart"></i> <!-- Hiển thị biểu tượng trái tim rỗng -->
                                    @endif
                                </a></li>
                            @else
                            <li><a href="/login" data-productid="{!! $pro['id'] !!}" class="wishlist">
                                    <i class="far fa-heart"></i> <!-- Nếu chưa đăng nhập, hiển thị biểu tượng trái tim rỗng và liên kết tới trang đăng nhập -->
                                </a></li>
                            @endif
                            <li><a href="/products/{!! $pro['id'] !!}"><i class="fa fa-retweet "></i></a></li> <!-- Liên kết tới trang chi tiết sản phẩm -->
                            <!-- <li><button type="submit"><i class="fa fa-shopping-cart"></i></button></li> -->
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        @if(isset($pro['name']))
                        <h6><a href="/products/{!! $pro['id'] !!}">{!! $pro['name'] !!}</a></h6>
                        @endif
                        @if(isset($pro['price']))
                        @if(isset($pro['price_new']))
                        <div class="product__discount__item__text">
                            <div class="product__item__price" style="color: #06121a">{!! number_format($pro['price_new']) !!}đ<span>{!! number_format($pro['price']) !!}đ</span></div>
                        </div>
                        @else
                        <div class="product__discount__item__text">
                            <div class="product__item__price" style="color: #06121a">{!! number_format($pro['price']) !!}đ</div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

    </div>
</section>
@section('script')
<script>
    totalWishlist();

    function totalWishlist() {
        $.ajax({
            type: 'GET',
            url: '/total_wishlist',
            success: function(response) {
                var response = JSON.parse(response);
                $('.total_wishlist').text(response);
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.wishlist').click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var users_id = "{!! Auth::id() !!}";
            var products_id = $(this).data('productid');
            $.ajax({
                type: 'POST',
                url: '/wishlist',
                data: {
                    products_id: products_id,
                    users_id: users_id
                },
                success: function(response) {
                    if (response.action == 'add') {
                        totalWishlist();
                        $('a[data-productid=' + products_id + ']').html('<i class="fas fa-heart"></i>');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'green');
                        $('#notifDiv').text(response.message);
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    } else if (response.action == 'remove') {
                        totalWishlist();
                        $('a[data-productid=' + products_id + ']').html('<i class="far fa-heart"></i>');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text(response.message);
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                }
            });
        });
    });
</script>
@endsection
@include('user.layout.product_latest')