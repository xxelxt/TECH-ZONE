@extends('user.layout.index')
@section('content')
@include('user.layout.menu_product')

<section class="breadcrumb-section set-bg" data-setbg="user_asset/images/breadcrumb.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>{!! $about['name'] !!}</h2>
          <div class="breadcrumb__option">
            <a href="/">@lang('lang.home')</a>
            <span> > @lang('lang.all') @lang('lang.products')</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="product spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-5">
        <div class="sidebar">
          <div class="sidebar__item">
            <h4>@lang('lang.all') @lang('lang.cate')</h4>
            <ul>
              @foreach($categories as $cat)
              <li><a href="/categories/{!! $cat['id'] !!}">{!! $cat['name'] !!}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-7">
        <div class="filter__item">
          <div class="row">
            <div class="col-lg-4 col-md-3 d-flex">
              <div class="filter__option">
                <span class="icon_grid-2x2"></span>
                <span class="icon_ul"></span>
              </div>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="filter__found">
                <h6>@lang('lang.all_headline') <span>{!! $count !!}</span>@lang('lang.number_all_products')</h6>
              </div>
            </div>
            <div class="col-lg-4 col-md-5 d-flex justify-content-end">
              <div class="filter__sort">
                <form action="{{ request()->url() }}" method="GET"> {{-- Update form method and action --}}
                  @csrf
                  <span>Sắp xếp theo</span>
                  <select name="sort" id="sort" onchange="this.form.submit()"> {{-- Add onchange event --}}
                    <option value="">Mặc định</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A -> Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Z -> A</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row product-list" id="product-list">
          @foreach($search as $pro)
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
              <div class="product__item__pic set-bg" data-setbg="user_asset/images/products/{!! $pro['image'] !!}">
                <ul class="product__item__pic__hover">
                  @if(Auth::check())
                  @php
                  $countWishlist =$wishlist->countWishlist($pro['id']);
                  @endphp
                  <li><a href="javascript:void(0)" data-productid="{!! $pro['id'] !!}" class="wishlist">
                      @if($countWishlist >0)
                      <i class="fas fa-heart"></i>
                      @else
                      <i class="far fa-heart"></i>
                      @endif
                    </a></li>
                  @else
                  <li><a href="/login" data-productid="{!! $pro['id'] !!}" class="wishlist">
                      <i class="far fa-heart"></i>
                    </a></li>
                  @endif
                  <li><a href="/products/{!! $pro['id'] !!}"><i class="fa fa-retweet"></i></a></li>
                </ul>
              </div>
              <div class="product__item__text">
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
          @endforeach
        </div>
        {!! $search->links() !!}
      </div>
    </div>
  </div>
</section>
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