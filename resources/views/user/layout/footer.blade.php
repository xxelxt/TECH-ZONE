<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./"><img src="upload/logos/{!! ($about!=null)?$about['logo']: '' !!}" alt=""></a>
                    </div>
                    <ul>
                        <li>@lang('lang.address'): {!! ($about!=null)?$about['address']: ''!!}</li>
                        <li>@lang('lang.phone'): {!! ($about!=null)?$about['phone']: ''!!}</li>
                        <li>Email: {!! ($about!=null)?$about['email']: ''!!}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-7 col-sm-7 offset-sm-1">
                <div class="footer__widget">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6>Danh mục sản phẩm</h6>
                            <ul class="footer__widget__list">
                                @foreach ($categories->take(6) as $category)
                                <li><a href="/categories/{{ $category['id'] }}">{{ $category['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6>&nbsp;</h6>
                            <ul class="footer__widget__list">
                                @foreach ($categories->slice(6, 6) as $category)
                                <li><a href="/categories/{{ $category['id'] }}">{{ $category['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Nhận thư từ TechZone</h6>
                    <p>Nhận thông báo về những sản phẩm và chương trình khuyến mãi mới nhất.</p>
                    <form action="#">
                        <input type="text" placeholder="Nhập email tại đây">
                        <button type="submit" class="site-btn">Đăng ký</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>