@extends('user.layout.index')  {{-- Assuming you're using a Blade template --}}

<style>
	/* Trong tệp CSS của bạn */
.login-container {
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 500px;
    margin: 0px auto 100px auto; /* Căn giữa theo chiều ngang */
    padding: 30px;
    border-radius: 8px; /* Bo góc */
}

.login-title {
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 25px;
}

.form-control {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #091d5e; /* Màu xanh khi focus */
    outline: none;
}

.checkbox-container {
    display: flex;
    align-items: center;
}

.checkbox-container input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-right: 10px;
}

.login-button {
    background-color: #153085; /* Màu xanh lá cây */
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
		transition: all 0.5s;
}

.login-button:hover {
    background-color: #091d5e; /* Hiệu ứng hover */
}

.register-button {
    background-color: #f0f0f0; /* Màu xám nhạt hoặc màu tùy chọn */
    color: #333;
    padding: 15px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%; /* Hoặc điều chỉnh độ rộng tùy thích */
    margin-top: 10px; /* Khoảng cách giữa nút đăng nhập và nút đăng ký */
		transition: all 0.5s;
}

.register-button:hover {
    background-color: #ddd; /* Hiệu ứng hover */
}

/* Tùy chỉnh giao diện liên kết quên mật khẩu */
.forgot-password-link {
    text-align: center;
    margin-top: 20px;
}

.forgot-password-link a {
    color: #333;
    text-decoration: none;
}

.login-button {
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 700;
	font-size: 17px;
	margin-top: 20px;
}

</style>

@section('content')
<h2 style="margin-top: 60px; font-size: 40px" class="login-title">@lang('lang.register_acc') TechZone</h2>
<div class="login-container"> {{-- Reuse the login container styling --}}
    <form action="/register" method="POST" class="login-form">
        @csrf

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $arr)
                    {{ $arr }}<br>
                @endforeach
            </div>
        @endif

        {{-- Registration Fields --}}
        <div class="form-group">
            <input type="text" name="firstname" class="form-control" placeholder="@lang('lang.fristname')" required>
        </div>

        <div class="form-group">
            <input type="text" name="lastname" class="form-control" placeholder="@lang('lang.lastname')" required>
        </div>

        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="@lang('lang.username')" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="@lang('lang.password')" required>
        </div>

        <div class="form-group">
            <input type="password" name="passwordagain" class="form-control" placeholder="@lang('lang.password_again')" required>
        </div>

        <div class="form-group">
            <button class="login-button" type="submit">@lang('lang.register')</button>
        </div>

        <p class="forgot-password-link"><a href="/login">@lang('lang.already_account')? @lang('lang.login')</a></p> 
    </form>
</div>
@endsection
