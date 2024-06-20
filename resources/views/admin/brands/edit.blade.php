@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.brands')</h1>
            <p class="text-muted">@lang('lang.edit')</p>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    @if(count($errors)>0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $arr)
        {{$arr}}<br>
        @endforeach
    </div>
    @endif
    @if (session('thongbao'))
    <div class="alert alert-success">
        {{session('thongbao')}}
    </div>
    @endif

    <form action="admin/brands/edit/{!! $brands['id'] !!}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.name')</label>
            <div class="col-md-11">
                <input type="text" value="{!! $brands['name'] !!}" class="form-control" name="name" placeholder="Nhập tên thương hiệu" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.image')</label>
            <div class="col-md-11">
                <input type="file" name="Image" class="form-control" id="imageInput">
                <div class="d-flex flex-column">
                    <div>
                        <span class="text-muted">@lang('lang.current_image')</span><br>
                        <img id="currentImage" src="user_asset/images/brands/{!! $brands['image'] !!}" width="300px" alt="">
                    </div>
                    <div class="ms-3" id="previewContainer">
                        <span class="text-muted" style="display: none;" id="newImageLabel"></span>
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 300px; margin-top: 10px;">
                    </div>
                </div>

            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.active')</label>
            <div class="col-md-11 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" value="1" @if( $brands['active']==1 ) checked @endif>
                    <label class="form-check-label">@lang('lang.yes')</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" value="0" @if( $brands['active']==0 ) checked @endif>
                    <label class="form-check-label">@lang('lang.no')</label>
                </div>
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
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const currentImage = document.getElementById('currentImage');
    const newImageLabel = document.getElementById('newImageLabel');
    const previewContainer = document.getElementById('previewContainer');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                currentImage.style.display = 'block';
                newImageLabel.style.display = 'none';
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                previewContainer.classList.add('d-flex');
            };
            reader.readAsDataURL(file);
        } else {
            currentImage.style.display = 'block';
            newImageLabel.style.display = 'none';
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            previewContainer.classList.remove('d-flex');
        }
    });
</script>
@endsection