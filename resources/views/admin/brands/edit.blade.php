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
                <img src="user_asset/images/brands/{!! $brands['image'] !!}" width="300px" alt="">
                <br>
                <input type="file" name="Image" class="form-control">
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