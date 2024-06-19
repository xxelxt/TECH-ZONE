@extends('user.layout.index')
@section('content')
@include('user.layout.menu_product')

<body>
    @if (isset($order))
    <section class="breadcrumb-section set-bg" data-setbg="user_asset/images/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('lang.order_detail')</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">@lang('lang.home')</a>
                            <span>@lang('lang.orders')</span>
                            <span>{{ $order->id }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad" style="padding-top: 60px">
    <div class="container">
      <h2 style="margin-bottom: 20px;"><b>Thông tin đơn hàng</b></h2>
      <div class="row">
        <div class="col-md-6">
          <p><strong>@lang('lang.order_id'):</strong> {{ $order->id }}</p>
          <p><strong>@lang('lang.created'):</strong> {{ $order->created_at }}</p>
          <p><strong>@lang('lang.updated'):</strong> {{ $order->updated_at }}</p>
          <p><strong>@lang('lang.total_price'):</strong> {{ number_format($order->total) }}đ</p>
        </div>
        <div class="col-md-6">
          <p><strong>@lang('lang.customer'):</strong> {{ $order->lastname }} {{ $order->firstname }}</p>
          <p><strong>@lang('lang.phone'):</strong> {{ $order->phone }}</p>
          <p><strong>Email:</strong> {{ $order->email }}</p>
          <p><strong>@lang('lang.address'):</strong> {{ $order->address }}, {{ $order->district }}, {{ $order->city }}</p>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-12">
          <p><strong>@lang('lang.content'):</strong> {{ $order->content }}</p>
          <p><strong>@lang('lang.active'):</strong>
            <span class="{{ $order->status == 1 ? 'text-warning' : ($order->status == 2 ? 'text-primary' : ($order->status == 3 ? 'text-success' : 'text-danger')) }}">
              @if($order->status == 1) @lang('lang.processing')
              @elseif($order->status == 2) @lang('lang.delivery')
              @elseif($order->status == 3) @lang('lang.success')
              @elseif($order->status == 4) @lang('lang.denied')
              @endif
            </span>
          </p>
          <p><strong>@lang('lang.payment_status'):</strong>
            <span class="{{ $order->payment_status == 1 ? 'text-warning' : 'text-success' }}">
              @if($order->payment_status == 1) @lang('lang.unpaid')
              @elseif($order->payment_status == 2) @lang('lang.paid')
              @endif
            </span>
          </p>
        </div>
      </div>

      <h2 class="mt-4" style="margin-bottom: 20px;"><b>Chi tiết sản phẩm</b></h2>
      <div class="row mt-6">
        <div class="col-lg-12">
          <div class="shoping__cart__table">
            <table class="table table-hover nowrap">
              <thead>
                <tr>
                  <th>@lang('lang.products')</th>
                  <th>@lang('lang.image')</th>
                  <th>@lang('lang.quanty')</th>
                  <th>@lang('lang.price')</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders_detail as $value)
                <tr>
                  <td>{!! $value['name'] !!}</td>
                  <td><img style="width: 100px" src="user_asset/images/products/{!! $value['image'] !!}" alt=""></td>
                  <td>{!! $value['quantity'] !!}</td>
                  <td>{!! number_format($value['price']) !!} đ</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
    @else
    <p>Không tìm thấy đơn hàng nào.</p> 
    @endif
</body>
@endsection
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