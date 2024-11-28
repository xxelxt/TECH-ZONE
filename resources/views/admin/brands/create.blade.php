@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.brands')</h1>
            <p class="text-muted">@lang('lang.add')</p>
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

    <form action="admin/brands/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.name')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" name="name" placeholder="@lang('lang.name') @lang('lang.brands')" maxlength="191" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.image')</label>
            <div class="col-md-11">
                <input type="file" name="Image" class="form-control" id="imageInput" required>
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.active')</label>
            <div class="col-md-11 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" value="1" checked>
                    <label class="form-check-label">@lang('lang.yes')</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" value="0">
                    <label class="form-check-label">@lang('lang.no')</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-11 offset-md-1">
                <button type="submit" class="btn btn-primary m-b-0">@lang('lang.submit')</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection

@section('script')
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
        }
    });
</script>
@endsection