<?php
use Gloudemans\Shoppingcart\Facades\Cart;
$content = Cart::content();
?>
<header class="header">
    <div class="header__top">
        <div class="container mb-2">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>{!! ($about!=null)?$about['email'] : ''!!}</li>
                            <li>{!! ($about!=null)?$about['title'] : '' !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{!! $about['linkfanpage'] !!}"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <span class="seLect" >@lang('lang.lang')</span >
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="lang/vi">@lang('lang.vi')</a></li>
                                <li><a href="lang/en">@lang('lang.en')</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            @hasrole('admin|user|staff')
                            <div class="dropdown show">
                                <a type="button" href="#" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>@lang('lang.hello') <span class="text-success">{!! Auth::user()->lastname !!} {!! Auth::user()->firstname !!}</span></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/profile">@lang('lang.profile')</a>
                                    <a class="dropdown-item" href="/your_orders">@lang('lang.your_orders')</a>
                                    <a class="dropdown-item" href="/logout">@lang('lang.logout')</a>
                                </div>
                            </div>
                            @else
                            <a href="/login"><i class="fa fa-user"></i>@lang('lang.login')</a>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-2">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./"><img src="upload/logos/{!! ($about!=null)?$about['logo']: '' !!}" alt="" width="300"></a>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top: 10px">
                <nav class="header__menu">
                    <ul>
                        <li class=""><a href="/">@lang('lang.home')</a></li>
                        <li><a href="/all_products">@lang('lang.products')</a></li>
                        <li><a href="#">Tin tức</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="#">Đánh giá</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Sự kiện</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Giới thiệu</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3" style="margin-top: 10px">
                <div class="header__cart">
                @auth
                    <ul>               
                        <li><a href="/wishlist_pages">
                            <i class="fas fa-heart"></i> <span class="total_wishlist"></span>
                        </a></li>
                        <li><a href="cart"><i class="fa fa-shopping-bag"></i> <span>{!! $content->count() !!}</span></a></li>                     
                    </ul>
                    <div class="header__cart__price">@lang('lang.total_price'): <span>{!! Cart::total(0,',','.').' '.'đ' !!}</span></div>
                @else
                    <ul>               
                        <li><a href="cart"><i class="fa fa-shopping-bag"></i> <span>{!! $content->count() !!}</span></a></li>                     
                    </ul>
                    <div class="header__cart__price">@lang('lang.total_price'): <span>{!! Cart::total(0,',','.').' '.'đ' !!}</span></div>
                @endauth

                </div>
            </div>
        </div>
        <div class="humberger__open" style="margin-top: 15px">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>