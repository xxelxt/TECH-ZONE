@extends('user.layout.index')
@section('content')
@include('user.layout.menu_product')

<body>
  <section class="breadcrumb-section set-bg" data-setbg="user_asset/images/breadcrumb.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>@lang('lang.orders')</h2>
            <div class="breadcrumb__option">
              <a href="./index.html">@lang('lang.home')</a>
              <span> > @lang('lang.orders')</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="shoping-cart spad">
    <div class="container">
      <div class="filter__item" style="padding-bottom: 30px">
        <div class="d-flex justify-content-between">
          <div class="hero__search__form">
            <form action="/your_orders" method="GET">
            @csrf 
              <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input style="height: 40px;" type="search" name="query" value="{{ Request::get('query') }}" placeholder="@lang('lang.search')...">
                <button style="color: #06121a; background-color: #f5f5f5; text-transform: none; letter-spacing: none;" type="submit" class="site-btn">@lang('lang.search')</button>
            </form>
          </div>
          <div class="filter__sort" style="margin-top: 15px">
            <form action="/your_orders" method="GET">
              @csrf
              <input type="hidden" name="query" value="{{ request('query') }}">
              <span>Lọc theo</span>
              <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="">Tất cả</option>
                <option value="1" {{ request('sort') == '1' ? 'selected' : '' }}>@lang('lang.processing')</option>
                <option value="2" {{ request('sort') == '2' ? 'selected' : '' }}>@lang('lang.delivery')</option>
                <option value="3" {{ request('sort') == '3' ? 'selected' : '' }}>@lang('lang.success')</option>
                <option value="4" {{ request('sort') == '4' ? 'selected' : '' }}>@lang('lang.denied')</option>
              </select>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping__cart__table">
            <table class="table table-hover nowrap">
              <div class="table-responsive">
                <thead>
                  <tr>
                    <th>@lang('lang.order_id')</th>
                    <th>@lang('lang.customer')</th>
                    <th>@lang('lang.phone')</th>
                    <th>@lang('lang.address')</th>
                    <th>@lang('lang.district')</th>
                    <th>@lang('lang.city')</th>
                    <th>@lang('lang.content')</th>
                    <th>@lang('lang.total_price')</th>
                    <th>@lang('lang.active')</th>
                    <th>@lang('lang.payment_status')</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $value)
                  @if(Auth::user()->id == $value['users_id'])
                  <tr>
                    <td>{!! $value['id'] !!}</td>
                    <td>{!! $value['lastname'] !!} {!! $value['firstname'] !!}</td>
                    <td>{!! $value['phone'] !!}</td>
                    <td>{!! $value['address'] !!}</td>
                    <td>{!! $value['district'] !!}</td>
                    <td>{!! $value['city'] !!}</td>
                    <td>{!! $value['content'] !!}</td>
                    <td>{!! number_format($value['total']) !!}đ</td>
                    <td class="{{ $value['status'] == 1 ? 'text-warning' : ($value['status'] == 2 ? 'text-primary' : ($value['status'] == 3 ? 'text-success' : 'text-danger')) }}">
                      @if($value['status'] == 1) @lang('lang.processing')
                      @elseif($value['status'] == 2) @lang('lang.delivery')
                      @elseif($value['status'] == 3) @lang('lang.success')
                      @elseif($value['status'] == 4) @lang('lang.denied')
                      @endif
                    </td>
                    <td class="{{ $value['payment_status'] == 1 ? 'text-warning' : 'text-success' }}">
                      @if($value['payment_status'] == 1) @lang('lang.unpaid')
                      @elseif($value['payment_status'] == 2) @lang('lang.paid')
                      @endif
                    </td>
                    <td><a href="/your_orders_detail/{!! $value['id'] !!}" class="btn btn-info">@lang('lang.detail')</a></td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
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