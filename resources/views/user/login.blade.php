@extends('user.layout.index')

<style>
	/* Trong tệp CSS của bạn */
.login-container {
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 450px;
    margin: 30px auto 100px auto; /* Căn giữa theo chiều ngang */
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

.login-button, .register-button {
	text-transform: uppercase;
	letter-spacing: 0.5px;
	font-weight: 500;
	font-size: 17px;
}

.login-button {
	margin-top: 20px;
}

</style>

@section('content')
<h2 style="margin-top: 75px; font-size: 40px" class="login-title">@lang('lang.login_user_prompt')</h2>
<div class="login-container">
    <form action="/login" method="POST" class="login-form">
        @csrf

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $arr)
                    {{ $arr }}<br>
                @endforeach
            </div>
        @endif

        <div class="form-group">
            <input type="text" name="login" class="form-control" placeholder="@lang('lang.login_prompt')" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="@lang('lang.password')" required>
        </div>

        <div class="form-group">
            <button class="login-button" type="submit">@lang('lang.login')</button>
            <button class="register-button" type="button" onclick="window.location.href='/register';">@lang('lang.create_account')</button>
						
						<p style="margin-top: 50px;" class="forgot-password-link"><a href="/forgetpassword">@lang('lang.forgot') @lang('lang.password_low')?</a></p>
        </div>
    </form>
</div>
@endsection