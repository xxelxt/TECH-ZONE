@extends('admin.layout.index')
@section('content')
@role('admin')

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
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.about')</h1>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <form action="admin/about" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">Icon</label>
            <div class="col-md-11">
                @if($about!=null)
                <img src="upload/icon/{!! $about['icon'] !!}" width="200px" alt="">
                @endif
                <input type="file" name="Image" class="form-control mt-2">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">Logo</label>
            <div class="col-md-11">
                @if($about!=null)
                <img src="upload/logos/{!! $about['logo'] !!}" width="200px" alt="">
                @endif
                <input type="file" name="Image" class="form-control mt-2">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.web_name')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->name:""}}" name="name">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.title')</label>
            <div class="col-md-11">
                <textarea class="form-control" name="title" rows="5" cols="50">{{($about!=null)?$about->title:""}}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.phone')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->phone:""}}" name="phone">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">Email</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->email:""}}" name="email">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.address')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->address:""}}" name="address">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.social_network')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->linkfanpage:""}}" name="linkfanpage">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">Copyright</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->copyright:""}}" name="copyright" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.worktime')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" value="{{($about!=null)?$about->worktime:""}}" name="worktime">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-11 offset-md-1">
                <button type="submit" class="btn btn-primary">@lang('lang.update')</button>
            </div>
        </div>
    </form>
</div>
@else
<h1 align="center">Tài khoản không có quyền truy cập</h1>
@endrole
@endsection