@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.discounts')</h1>
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

    <form action="admin/discounts/edit/{!! $discounts['id'] !!}" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.code')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" name="code" value="{!! $discounts['code'] !!}" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.discounts')</label>
            <div class="col-md-11">
                <input type="number" class="form-control" name="discounts" value="{!! $discounts['discounts'] !!}" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.quanty')</label>
            <div class="col-md-11">
                <input type="number" class="form-control" name="quantity" value="{!! $discounts['quantity'] !!}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-11 offset-md-1">
                <button type="submit" class="btn btn-primary m-b-0">@lang('lang.update')</button>
            </div>
        </div>
    </form>
</div>
@endsection