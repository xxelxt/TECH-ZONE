@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.staff')</h1>
            <p class="text-muted">@lang('lang.edit'): {!! $user['username'] !!}</p>
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

        <form action="admin/staff/edit/{!! $user['id'] !!}" method="POST">
            @csrf
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.fristname')</label>
                <div class="col-md-11">
                    <input type="text" value="{!! $user['firstname'] !!}" class="form-control" name="firstname" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.lastname')</label>
                <div class="col-md-11">
                    <input type="text" value="{!! $user['lastname'] !!}" class="form-control" name="lastname" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.username')</label>
                <div class="col-md-11">
                    <input type="text" value="{!! $user['username'] !!}" class="form-control" name="username" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">Email</label>
                <div class="col-md-11">
                    <input type="text" value="{!! $user['email'] !!}" class="form-control" name="email" placeholder="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.social_network')</label>
                <div class="col-md-11">
                    <input class="form-control" type="text" value="{!! $user['facebook'] !!}" name="facebook" placeholder="Enter Social Network" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-1 col-form-label">@lang('lang.phone')</label>
                <div class="col-md-11">
                    <input class="form-control" type="phone" value="{!! $user['phone'] !!}" name="phone" placeholder="Enter Phone Number" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-1">
                    <input type="checkbox" id="checkChangpassword" name="changepassword">
                    <label for="checkChangpassword" class="form-check-label">Đổi mật khẩu</label>
                </div>
                <div class="col-md-5">
                    <input type="password" class="password form-control" name="password" disabled placeholder="Enter Password" />
                </div>
                <div class="col-md-6">
                    <input type="password" class="password form-control" name="passwordagain" disabled placeholder="Enter RePassword" />
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
        $(document).ready(function(){
            $('#checkChangpassword').change(function(){
            if($(this).is(":checked"))
            {
                $('.password').removeAttr('disabled');
            }
            else 
                {
                 $('.password').attr('disabled','');
                 }
            });
        });
    </script>
@endsection