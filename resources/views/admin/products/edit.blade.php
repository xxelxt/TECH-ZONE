@extends('admin.layout.index')

@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.products')</h1>
            <p class="text-muted">@lang('lang.edit')</p>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $arr)
        {{ $arr }}<br>
        @endforeach
    </div>
    @endif
    @if (session('thongbao'))
    <div class="alert alert-success">
        {{ session('thongbao') }}
    </div>
    @endif

    <form action="admin/products/edit/{!! $products['id'] !!}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.cate')</label>
            <div class="col-md-11">
                <select name="categories_id" class="form-control" id="category">
                    @foreach ($categories as $value)
                    <option @if ($products['categories']['id']==$value['id']) selected @endif value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.sub')</label>
            <div class="col-md-11">
                <select name="sub_id" class="form-control" id="subcategory">
                    @foreach ($subcategories as $value)
                    <option @if ($products['subcategories']['id']==$value['id']) selected @endif value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.brands')</label>
            <div class="col-md-11">
                <select name="brands_id" class="form-control">
                    @foreach ($brands as $value)
                    <option @if ($products['brands']['id']==$value['id']) selected @endif value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.name')</label>
            <div class="col-md-11">
                <input class="form-control" name="name" placeholder="@lang('lang.enter') @lang('lang.name')" value="{!! $products['name'] !!}" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.image')</label>
            <div class="col-md-11">
                <input type='file' name='Image' class="form-control" id="imageInput">
                <div class="d-flex flex-column">
                    <div>
                        <span class="text-muted">@lang('lang.current_image')</span><br>
                        <img id="currentImage" src="user_asset/images/products/{!! $products['image'] !!}" width="200px" alt="">
                    </div>
                    <div class="ms-3" id="previewContainer">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 200px; margin-top: 10px;">
                    </div>
                </div>

            </div>
        </div>

        {{-- Thư viện ảnh --}}
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.image_library')</label>
            <div class="col-md-11" id="libraryContainer">
                <input type='file' name='imagelibrary[]' class="form-control" id="libraryInput" multiple>
                <div class="row mt-2">
                    @foreach($products->Imagelibrary as $value)
                    <div class="col-md-2 text-center">
                        <a href="javascript:void(0)" data-url="{{ url('ajax/deleteimages', $value['id'] ) }}" class="btn text-danger delete-image">X</a>
                        <img src="user_asset/images/products/{!! $value['image_library'] !!}" style="width: 200px; height: auto;" alt="">
                    </div>
                    @endforeach
                </div>
                <div id="libraryPreview" class="row mt-2"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.size')</label>
            <div class="col-md-11">
                <input class="form-control" name="size" placeholder="@lang('lang.enter') @lang('lang.size')" value="{!! $products['size'] !!}" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.quanty')</label>
            <div class="col-md-11">
                <input class="form-control" type="number" name="quantity" placeholder="@lang('lang.enter') @lang('lang.quanty')" value="{!! $products['quantity'] !!}" />
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">Video</label>
            <div class="col-md-11">
                <input class="form-control" id="link" name="link" placeholder="https://www.youtube.com/watch?v=" value="{!! $products['link'] !!}"/>
                <div id="videoPreview" style="margin-top: 10px;">
                    @if(isset($products['link']))
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{!! $products['link'] !!}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.price')</label>
            <div class="col-md-11">
                <input class="form-control" type="number" name="price" placeholder="@lang('lang.enter') @lang('lang.price')" value="{!! $products['price'] !!}" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-1">
                <input type="checkbox" id="checkPrice" name="changeprice">
                <label for="checkPrice" class="form-check-label">@lang('lang.new_price')</label>
            </div>
            <div class="col-md-11">
                <input class="price_new form-control" type="number" name="price_new" disabled placeholder="@lang('lang.enter') @lang('lang.new_price')" value="{!! $products['price_new'] !!}" />
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.content')</label>
            <div class="col-md-11">
                <textarea class="form-control" name="content" id="editor" placeholder="@lang('lang.enter') @lang('lang.content')">{!! $products['content'] !!}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-11 offset-md-1">
                <button type="submit" class="btn btn-primary">@lang('lang.update')</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#checkPrice').change(function() {
            if ($(this).is(":checked")) {
                $('.price_new').removeAttr('disabled');
            } else {
                $('.price_new').attr('disabled', '');
            }
        });
    });
</script>
<script>
    //active
    $(document).ready(function() {
        $("#category").change(function() {
            var cat_id = $(this).val();
            $.get("ajax/Subcategories/" + cat_id, function(data) {
                $("#subcategory").html(data);
            });
        });
    });
    //delete ajax 
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-image').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") == true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        if (data['success']) {
                            alert(data.success);
                            trObj.parents("tr").remove();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }

        });
    });
</script>
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const currentImage = document.getElementById('currentImage');
    const previewContainer = document.getElementById('previewContainer');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                currentImage.style.display = 'block';
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                previewContainer.classList.add('d-flex');
            };
            reader.readAsDataURL(file);
        } else {
            currentImage.style.display = 'block';
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            previewContainer.classList.remove('d-flex');
        }
    });

    // Xử lý xem trước cho ảnh mô tả (Image Library)
    const libraryInput = document.getElementById('libraryInput');
    const libraryPreview = document.getElementById('libraryPreview');
    const libraryContainer = document.getElementById('libraryContainer');

    libraryInput.addEventListener('change', function() {
        libraryPreview.innerHTML = ''; // Xóa các ảnh preview cũ

        for (const file of this.files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.margin = '15px';
                libraryPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }

        // Hiển thị libraryPreview nếu có ảnh được chọn
        libraryPreview.style.display = this.files.length > 0 ? 'flex' : 'none';
    });

    // Xử lý thêm iframe video
    const linkInput = document.getElementById('link');
    const videoPreview = document.getElementById('videoPreview');

    linkInput.addEventListener('input', function() {
        const link = this.value;
        if (link.includes('youtube.com/watch?v=')) {
            const videoId = link.split('v=')[1].split('&')[0];
            const embedUrl = `https://www.youtube.com/embed/${videoId}`;
            videoPreview.innerHTML = `<iframe width="560" height="315" src="${embedUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        } else {
            videoPreview.innerHTML = ''; // Xóa iframe nếu link không hợp lệ
        }
    });
</script>
@endsection