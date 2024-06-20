@extends('user.layout.index')
@section('content')
@include('user.layout.menu_product')

<style>
  .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
  }

  .rating input[type="radio"] {
    display: none;
  }

  .rating label {
    position: relative;
    display: inline-block;
    font-size: 2em;
    color: #ccc;
    cursor: pointer;
    --star-size: 0px;
  }

  .rating label::before {
    content: '\f005 \f005 \f005 \f005 \f005';
    /* 5 ngôi sao xám */
    font-family: FontAwesome;
  }

  .rating label::after {
    content: '\f005 \f005 \f005 \f005 \f005';
    /* 5 ngôi sao vàng */
    font-family: FontAwesome;
    color: #EDBB0E;
    position: absolute;
    left: 0;
    top: 0;
    width: var(--star-size);
    height: 22.5px;
    overflow: hidden;
  }

  /* Style for the enlarged image */
  #enlargedImage {
    max-width: 100%;
    height: auto;
    margin-top: 20px;
    /* Add spacing above enlarged image */
  }
</style>
<section class="product-details spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="product__details__pic">
          <div id="enlargedImageCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @php
              $mainImageUrl = asset('user_asset/images/products/' . $products['image']);
              @endphp
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ $mainImageUrl }}" alt="Main Product Image">
              </div>
              @foreach($products['Imagelibrary'] as $value)
              @if(isset($value['image_library']))
              @php
              $galleryImageUrl = asset('user_asset/images/products/' . $value['image_library']);
              @endphp
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ $galleryImageUrl }}" alt="Gallery Image">
              </div>
              @endif
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#enlargedImageCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#enlargedImageCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="product__details__pic__slider owl-carousel" style="margin-top: 20px">
            <img src="{{ $mainImageUrl }}" alt="" onclick="enlargeImage('{{ $mainImageUrl }}')">
            @foreach($products['Imagelibrary'] as $value)
            @if(isset($value['image_library']))
            @php
            $galleryImageUrl = asset('user_asset/images/products/' . $value['image_library']);
            @endphp
            <img src="{{ $galleryImageUrl }}" alt="" onclick="enlargeImage('{{ $galleryImageUrl }}')">
            @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="product__details__text">
          <h3>{!! $products['name'] !!}</h3>
          <div class="product__details__rating">
            @if(count($ratings)!=0)
            <?php
            $count = count($ratings);
            $sum = 0;
            foreach ($ratings as $rt) {
              $sum += $rt['ratings'];
            }
            if ($count != 0) {
              $avgStar_ratings = round($sum / $count, 2);
            } else {
              $avgStar_ratings = 0;
            }
            $star = 0;
            while ($star < 5) {
              if (($avgStar_ratings - $star) > 0.5) {
            ?>
                <i class="fa fa-star"></i>
              <?php
              } else if (($avgStar_ratings - $star) == 0.5) {
              ?>
                <i class="fa fa-star-half"></i>
              <?php
              } else if (($avgStar_ratings - $star) < 0.5) {
              ?>
                <i class="fa fa-star-o"></i>
            <?php
              }
              $star++;
            }
            ?>
            <span>({!! count($ratings) !!} @lang('lang.reviews'))</span>
            @else

            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <span>(0 @lang('lang.reviews'))</span>

            @endif
          </div>
          <div class="product__details__price">
            @if(isset($products['price_new']))
            @if(!isset($products['price']))
            {!! number_format($products['price_new']) !!}₫
            @else
            <span style="text-decoration: line-through;color: rgb(187, 181, 172);font-size: 20px;">{!! number_format($products['price']) !!}₫</span>
            {!! number_format($products['price_new']) !!}₫
            @endif
            @else
            {!! number_format($products['price']) !!}₫
            @endif
          </div>
          <form action="/cart" method="POST">
            @csrf
            <div class="product__details__quantity">
              <div class="quantity">
                <div class="pro-qty">
                  <input name="qty" type="number" min="1" max="{!! $products['quantity'] !!}" value="1">
                </div>
                <input name="productid_hidden" type="hidden" value="{!! $products['id'] !!}">
              </div>
            </div>
            <button type="submit" class="primary-btn" style="border: none">@lang('lang.add_to_cart')</button>
            @if(Auth::check())
            <!-- thêm trai tim yêu thích (chỉ được kích khi đã đăng nhập) -->
            <a href="javascript:void(0)" data-productid="{!! $products['id'] !!}" class="wishlist">
              @if($countWishlist >0)
              <i class="fas fa-heart "></i>
              @else
              <i class="far fa-heart "></i>
              @endif
            </a>
            @else
            <a href="/login" data-productid="{!! $products['id'] !!}" class=" wishlist">
              <i class="far fa-heart "></i>
            </a>
            @endif
          </form>
          <ul>
            <li><b>@lang('lang.brands')</b> <span>{!! $products['brands']['name'] !!}</span></li>
            <li><b>@lang('lang.availability')</b>
              @if($products['active'] == 1)
              <span class="text-success">@lang('lang.in_stock')</span>
              @else
              <span class="text-danger">@lang('lang.out_stock')</span>
              @endif
            </li>
            @if (!empty($products['size']))
            <li><b>@lang('lang.size')</b> <span>{!! $products['size'] !!}</span></li>
            @endif
            <li><b>@lang('lang.quanty')</b> <span>{!! $products['quantity'] !!}</span></li>
          </ul>
          @if(Auth::check())
          <button class="btndanhgia">@lang('lang.your_review')</button>
          <div class="formdanhgia">
            <form action="/addRating" method="POST">
            <input type="hidden" name="rating_value" id="ratingValue">
              @csrf
              <h6 class="tieude text-uppercase">GỬI ĐÁNH GIÁ CỦA BẠN</h6>
              <span class="danhgiacuaban">Đánh giá của bạn về sản phẩm này:</span>
              <div class="rating">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5"></label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4"></label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3"></label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2"></label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1"></label>
              </div>
              <div class="form-group">
                <textarea class="form-control txtComment w-100" name="content" id="editor" placeholder="Đánh giá của bạn về sản phẩm này"></textarea>
              </div>
              <input type="hidden" name="products_id" value="{!! $products['id'] !!}">
              <button type="submit" class="btn nutguibl">Gửi bình luận</button>
            </form>
          </div>
          @else
          <form action="/login">
            <button class="btndanhgia">@lang('lang.please_login_before_rating')</button>
          </form>
          @endif
        </div>
      </div>
      <div class="col-lg-12">
        <div class="product__details__tab">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">@lang('lang.description')</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">@lang('lang.reviews') <span>({!! count($ratings) !!})</span></a>
            </li>
          </ul>
          <div class="tab-content">
            @if(isset($products['content']))
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
              <div class="product__details__tab__desc">
                <h4><b>@lang('lang.product_info')</b></h4>
                <p>{!! $products['content'] !!}</p>
                @if(isset($products['link']))
                <p> <iframe style="height: 700px;" width="100%" src="https://www.youtube.com/embed/{!! $products['link'] !!} " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
                @endif
              </div>
            </div>
            @endif
            <div class="tab-pane" id="tabs-3" role="tabpanel">
              <div class="product__details__tab__desc">
                @if(count($ratings)>0)
                @foreach($ratings as $value)
                <h5 style="margin-bottom: 0px">{!! $value['users']['lastname'] !!} {!! $value['users']['firstname'] !!}</h5>
                <ul class="ral rating">
                  <?php
                  $count = 0;
                  while ($count < 5) {
                    if (($value['ratings'] - $count) > 0.5) {
                  ?>
                      <li><i class="fa fa-star"></i></li>
                    <?php
                    } else if (($value['ratings'] - $count) == 0.5) {
                    ?>
                      <li><i class="fa fa-star-half"></i></li>
                    <?php
                    } else if (($value['ratings'] - $count) < 0.5) {
                    ?>
                      <li><i class="fa fa-star-o"></i></li>
                  <?php
                    }
                    $count++;
                  }
                  ?>
                </ul>
                <p style="font-size: 12px;">{!! $value['created_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</p>
                <h6>{!! $value['content'] !!}</h6>
                @endforeach
                @else
                <h3 style="margin-bottom: 0px;text-align: center;">@lang('lang.none_rating')</h3>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title related__product__title">
          <h2>@lang('lang.related_product')</h2>
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($related_products as $related)
      @if($related['active'] == 1)
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="product__item">
          <div class="product__item__pic set-bg" data-setbg="user_asset/images/products/{!! $related['image'] !!}">
            <ul class="product__item__pic__hover">
              @if(Auth::check())
              @php
              $countWishlist =$wishlist->countWishlist($related['id']);
              @endphp
              <li><a href="javascript:void(0)" data-productid="{!! $related['id'] !!}" class="wishlist">
                  @if($countWishlist >0)
                  <i class="fas fa-heart"></i>
                  @else
                  <i class="far fa-heart"></i>
                  @endif
                </a></li>
              @else
              <li><a href="/login" data-productid="{!! $related['id'] !!}" class="wishlist">
                  <i class="far fa-heart"></i>
                </a></li>
              @endif
              <li><a href="/products/{!! $related['id'] !!}"><i class="fa fa-retweet"></i></a></li>
            </ul>
          </div>
          <div class="product__item__text">
            @if(isset($related['name']))
            <h6><a href="/products/{!! $related['id'] !!}">{!! $related['name'] !!}</a></h6>
            @endif
            @if(isset($related['price']))
            @if(isset($related['price_new']))
            <div class="product__discount__item__text">
              <div class="product__item__price" style="color: #06121a">{!! number_format($related['price_new']) !!}đ<span>{!! number_format($related['price']) !!}đ</span></div>
            </div>
            @else
            <div class="product__discount__item__text">
              <div class="product__item__price" style="color: #06121a">{!! number_format($related['price']) !!}đ</div>
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
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  var rating = document.querySelector('.btndanhgia');
  var form_rating = document.querySelector('.formdanhgia');
  rating.addEventListener('click', function() {
    form_rating.classList.toggle('active')
  })
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
    ratingInputs.forEach(input => {
      input.addEventListener('change', function() {
        const ratingValue = this.value;
        document.getElementById('ratingValue').value = ratingValue;
        console.log(ratingValue);

        const labels = document.querySelectorAll('.rating label');
        labels.forEach((label, index) => {
          const starIndex = 5 - index; // Do ngôi sao xếp ngược
          if (starIndex <= ratingValue) {
            // Cập nhật giá trị biến CSS
            label.style.setProperty('--star-size', '15px');
          } else {
            label.style.setProperty('--star-size', '0px');
          }
        });
      });
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
            $('a[data-productid=' + products_id + ']').html('<i class="fas fa-heart "></i>');
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'green');
            $('#notifDiv').text(response.message);
            setTimeout(() => {
              $('#notifDiv').fadeOut();
            }, 3000);
          } else if (response.action == 'remove') {
            totalWishlist();
            $('a[data-productid=' + products_id + ']').html('<i class="far fa-heart "></i>');
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
<script>
  function enlargeImage(imageUrl) {
    let index = 0;
    $('#enlargedImageCarousel .carousel-item img').each(function(i) {
      if ($(this).attr('src') === imageUrl) {
        index = i;
        return false;
      }
    });
    $('#enlargedImageCarousel').carousel(index);
  }
</script>
@endsection