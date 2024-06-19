<div class="email-container">
	<!-- Header -->
	<div class="header">
		<h1>Quên mật khẩu?</h1>
	</div>

	<!-- Nội dung email -->
	<div class="email-content">
		<p style="font-size: 15px;">Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.
			Nhấn vào <a href="{{$data['body']}}" class="reset-password-button">đây</a> để đặt lại mật khẩu.</p>

	</div>

	<!-- Footer -->
	<div class="footer">
		<p style="font-size: 15px;">Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
	</div>

	@php
	$about = DB::table('abouts')->first();
	@endphp
	<div class="store-info" style="color: dimgray; line-height: 12px; margin-top: 20px">
    <p style="font-size: 14px;"><b>{{ $about->name }}</b></p>
    <p style="font-size: 14px;">Địa chỉ: {{ $about->address }}</p>
    <p style="font-size: 14px;">Số điện thoại: {{ $about->phone }}</p>
    <p style="font-size: 14px;">Email: {{ $about->email }}</p>
    <p style="font-size: 14px;">Website: techzone.io</p>
</div>

</div>