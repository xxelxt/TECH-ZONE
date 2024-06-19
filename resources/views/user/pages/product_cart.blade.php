@extends('user.layout.index')
@section('content')
@include('user.layout.menu_product')
<?php

use Gloudemans\Shoppingcart\Facades\Cart;

$content = Cart::content();

?>

<body>
  <section class="breadcrumb-section set-bg" data-setbg="user_asset/images/breadcrumb.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>@lang('lang.shopping_cart')</h2>
            <div class="breadcrumb__option">
              <a href="./index.html">@lang('lang.home')</a>
              <span> > @lang('lang.shopping_cart')</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="shoping-cart spad">
    <div class="container">
      @if (Cart::count() != 0)
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping__cart__table">
            <table>
              <thead>
                <tr>
                  <th class="shoping__product">@lang('lang.products')</th>
                  <th>@lang('lang.price')</th>
                  <th>@lang('lang.quanty')</th>
                  <th>@lang('lang.total_price')</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($content as $value)
                <tr>
                  <td class="shoping__cart__item">
                    <img src="user_asset/images/products/{!! $value->options->image !!}" width="75px" alt="">
                    <h5><a href="{{ url('products/'.$value->id) }}">{!! $value->name !!}</a></h5>
                  </td>
                  <td class="shoping__cart__price">
                    @if($value->options->price_new)
                    {!! number_format($value->options->price_new).' '.'đ' !!}
                    @else
                    {!! number_format($value->price).' '.'đ' !!}
                    @endif
                  </td>
                  <td class="shoping__cart__quantity">
                    <div class="quantity">
                      <div class="pro-qty">
                        <input type="text" name="cart_quantity" value="{{ $value->qty }}" min="1" data-rowid="{{ $value->rowId }}" class="cart-quantity-input" readonly>
                      </div>
                    </div>
                  </td>
                  <td class="shoping__cart__total">
                    <?php
                    if ($value->options->price_new) {
                      $value->price = $value->options->price_new;
                      $sum = $value->price * $value->qty;
                    } else {
                      $sum = $value->price * $value->qty;
                    }
                    echo number_format($sum) . ' ' . 'đ';
                    ?>
                  </td>
                  <td class="shoping__cart__item__close">
                    <a href="/delete_cart/{!! $value->rowId !!}"> <span class="icon_close"></span></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6" style="padding-top: 10px">
          <div class="shoping__continue">
            <div class="shoping__discount">
              <h5>@lang('lang.coupon')</h5>

              <form action="/discount" method="POST" class="d-flex align-items-center">
                <div class="filter__sort">
                  @csrf
                  <input type="text" name="code" placeholder="@lang('lang.enter') @lang('lang.coupon')">
                  <button type="submit" class="site-btn" style="margin-right: 10px; border: none">@lang('lang.apply')</button>

                  @if (Cart::discount() > 0)
                  <button type="submit" formaction="/delete_discount" class="primary-btn cart-btn cart-btn-right" style="border: none">@lang('lang.delete_coupon')</button>
                  @endif
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6" style="padding-top: 10px">
        <div class="shoping__checkout">
          <h5>@lang('lang.cart_total')</h5>
          <ul>
            <li>@lang('lang.subtotal') <span> {!! Cart::pricetotal(0,',','.').' '.'đ' !!}</span></li>
            <li>@lang('lang.discounts')<span> {!! Cart::discount(0,',','.').' '.'đ' !!}</span></li>
            <li>@lang('lang.tax') <span> {!! Cart::tax(0,',','.').' '.'đ' !!}</span></li>
            <li>@lang('lang.total_price') <span> {!! Cart::total(0,',','.').' '.'đ' !!}</span></li>
          </ul>
          <a href="/checkout" class="primary-btn">@lang('lang.proceed_checkout')</a>
          <a style="margin-top: 10px; color: #1c1c1c; background-color: #e5e5e5;" href="/" class="primary-btn">@lang('lang.continue_shopping')</a>
        </div>
      </div>
      @else
      <h4 style="margin-bottom: 100px"><b>Không có sản phẩm nào trong giỏ hàng.</b></h4>
      @endif
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

    // Handle Decrease Button Click
    $('.shoping__cart__quantity').on('click', '.dec', function() {
      var input = $(this).siblings('.cart-quantity-input');
      var qty = parseInt(input.val());

      if (qty < 1) {
        qty = 1;
      }

      input.val(qty); // Update the input value without triggering the change event

      // Trigger AJAX Update
      updateCart(input);
    });

    // Handle Increase Button Click
    $('.shoping__cart__quantity').on('click', '.inc', function() {
      var input = $(this).siblings('.cart-quantity-input');
      var qty = parseInt(input.val());

      input.val(qty); // Update the input value without triggering the change event

      // Trigger AJAX Update
      updateCart(input);
    });

    // Update Cart Function
    function updateCart(input) {
      var rowId = input.data('rowid');
      var qty = parseInt(input.val());

      $.ajax({
        type: 'POST',
        url: '/update_cart',
        data: {
          rowId_cart: rowId,
          cart_quantity: qty,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          location.reload();
        }
      });
    }
  });
</script>
@endsection