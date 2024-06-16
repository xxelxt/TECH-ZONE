<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($brands as $br)
                @if(isset($br['image']))
                <div class="col-lg-3" style="height: 150px;">
                    <a href="/brands/{!! $br['id'] !!}">
                        <div class="categories__item d-flex justify-content-center align-items-center">
                            <img src="user_asset/images/brands/{!! $br['image'] !!}" alt="" style="width: 50%; position: center">
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>