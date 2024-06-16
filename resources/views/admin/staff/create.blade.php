@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.staff')</h1>
            <p class="text-muted">@lang('lang.add')</p>
        </div>
    </div>
</div>
<div class="card" style="border: none; margin: 30px;">
        @if(count($errors)>0)
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

        <form action="admin/staff/create" method="POST">
            @csrf
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.fristname')</label>
                <div class="col-md-11">
                    <input class="form-control" name="firstname" placeholder="@lang('lang.enter') @lang('lang.fristname')" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.lastname')</label>
                <div class="col-md-11">
                    <input class="form-control" name="lastname" placeholder="@lang('lang.enter') @lang('lang.lastname')" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.username')</label>
                <div class="col-md-11">
                    <input class="form-control" type="text" name="username" placeholder="@lang('lang.enter') @lang('lang.username')" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">Email</label>
                <div class="col-md-11">
                    <input class="form-control" type="email" name="email" placeholder="@lang('lang.enter') Email" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.social_network')</label>
                <div class="col-md-11">
                    <input class="form-control" type="text" name="facebook" placeholder="@lang('lang.enter') @lang('lang.social_network')" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.phone')</label>
                <div class="col-md-11">
                    <input class="form-control" type="phone" name="phone" placeholder="@lang('lang.enter') @lang('lang.phone')" />
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
                <label class="col-md-1 col-form-label">@lang('lang.password')</label>
                <div class="col-md-11">
                    <input type="password" class="form-control" name="password" placeholder="@lang('lang.enter') @lang('lang.password')" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.password_again')</label>
                <div class="col-md-11">
                    <input type="password" class="form-control" name="passwordagain" placeholder="@lang('lang.password_again')" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-11 offset-md-1">
                    <button type="submit" class="btn btn-primary m-b-0">@lang('lang.add')</button>
                </div>
            </div>
        </form>
</div>
@endsection