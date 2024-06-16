@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.ban')</h1>
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

        <form action="admin/banners/edit/{!! $banners['id'] !!}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.image')</label>
                <div class="col-md-11">
                    <img src="user_asset/images/banners/{!! $banners['image'] !!}" width="700px" alt="">
                    <br>
                    <input type="file" name="Image" class="form-control mt-2">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.active')</label>
                <div class="col-md-11 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="active" value="1" @if($banners['active'] == 1) checked @endif>
                        <label class="form-check-label">@lang('lang.yes')</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="active" value="0" @if($banners['active'] == 0) checked @endif>
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