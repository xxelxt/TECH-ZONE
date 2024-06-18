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
                        <h2>@lang('lang.checkout')</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">@lang('lang.home')</a>
                            <span> > @lang('lang.checkout')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>@lang('lang.billing_details')</h4>
                <form id="checkoutForm" action="/order_place" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>@lang('lang.lastname')<span> *</span></p>
                                        @if(Auth::check())
                                        <input type="text" name="lastname" value="{!! $user['lastname']?$user['lastname']:'' !!}" required>
                                        @else
                                        <input type="text" name="lastname" required>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>@lang('lang.fristname')<span> *</span></p>
                                        @if(Auth::check())
                                        <input type="text" name="firstname" value="{!! $user['firstname']?$user['firstname']:'' !!}" required>
                                        @else
                                        <input type="text" name="firstname" required>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>@lang('lang.address')<span> *</span></p>
                                <input type="text" name="address" class="checkout__input__add" required>
                            </div>
                            <div class="checkout__input">
                                <p>@lang('lang.district')<span> *</span></p>
                                <input type="text" name="district" required>
                            </div>
                            <div class="checkout__input">
                                <p>@lang('lang.city')<span> *</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>@lang('lang.phone')<span> *</span></p>

                                        @if(Auth::check())
                                        <input type="text" name="phone" value="{!! $user['phone']?$user['phone']:'' !!}" required>
                                        @else
                                        <input type="text" name="phone" required>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span> *</span></p>

                                        @if(Auth::check())
                                        <input type="text" name="email" value="{!! $user['email']?$user['email']:'' !!}" required>
                                        @else
                                        <input type="text" name="email" required>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>@lang('lang.order_notes')</p>
                                <input type="text" name="content" placeholder="@lang('lang.write_order_notes')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>@lang('lang.your_orders')</h4>
                                <div class="checkout__order__products">@lang('lang.products') <span>@lang('lang.total_price')</span></div>
                                @foreach($content as $value)
                                <ul>
                                    <li>{!! $value->name !!}
                                        <span>
                                            <?php
                                            if ($value->options->price_new) {
                                                $value->price = $value->options->price_new;
                                                $sum = $value->price * $value->qty;
                                            } else {
                                                $sum = $value->price * $value->qty;
                                            }
                                            echo number_format($sum) . ' ' . 'đ';
                                            ?>
                                        </span>
                                    </li>
                                </ul>
                                @endforeach
                                <div class="checkout__order__subtotal">@lang('lang.subtotal') <span>{!! Cart::pricetotal(0,',','.').' '.'đ' !!}</span></div>
                                <div class="checkout__order__total">@lang('lang.discounts') <span>{!! Cart::discount(0,',','.').' '.'đ' !!}</span></div>
                                <div class="checkout__order__total">@lang('lang.total_price') <span>{!! Cart::total(0,',','.').' '.'đ' !!}</span></div>
                                <p>Hình thức thanh toán</p>
                                <div class="checkout__input__checkbox">
                                    <input type="radio" name="payment_method" id="payment_method_cod" value="cod" checked>
                                    <label for="payment_method_cod">Thanh toán khi nhận hàng (COD)</label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <input type="radio" name="payment_method" id="payment_method_vnpay" value="vnpay">
                                    <label for="payment_method_vnpay">VNPAY</label>
                                </div>
                                <button type="submit" id="placeOrderBtn" class="site-btn">@lang('lang.place_order')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#checkoutForm').submit(function(event) {
            const selectedPaymentMethod = $('input[name="payment_method"]:checked').val();

            if (selectedPaymentMethod === 'vnpay') {
                event.preventDefault();
                // Dynamically create and append the hidden input
                var redirectInput = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'redirect')
                    .val('1'); // Or any value you want to indicate the redirect

                $(this).append(redirectInput);
                this.action = "{{ route('vnpay_payment') }}";
                this.submit();
            }
        });
    });
</script>
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