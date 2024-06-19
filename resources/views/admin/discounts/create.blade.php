@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.discounts')</h1>
            <p class="text-muted">@lang('lang.add')</p>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $arr)
        {{$arr}}<br>
        @endforeach
    </div>
    @endif

    <form action="admin/discounts/create" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.code')</label>
            <div class="col-md-11">
                <input type="text" class="form-control" name="code" placeholder="@lang('lang.code') @lang('lang.discounts')" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.discounts')</label>
            <div class="col-md-11">
                <input type="number" class="form-control" name="discounts" placeholder="" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-1 col-form-label">@lang('lang.quanty')</label>
            <div class="col-md-11">
                <input type="number" class="form-control" name="quantity" placeholder="" required>
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
@endsection