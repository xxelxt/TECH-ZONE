<!doctype html>
<html lang="en">

<head>
	<title>@lang('lang.title_login')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<base href="{{asset('')}}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="loginform/css/style.css">
	<style>
		body {
			background: #f8f9fa;
			font-family: 'Lato', sans-serif;
		}

		.container {
			margin-top: 100px;
			padding: 20px;
		}

		.wrap {
			box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			overflow: hidden;
			padding: 50px;
		}

		.login-wrap {
			background: #fff;
			padding: 40px;
			border-radius: 10px;
		}

		.form-group input {
			height: 45px;
			border: 1px solid #ddd;
			padding-left: 20px;
		}

		.form-group input:focus {
			border-color: #007bff;
		}

		.btn-primary {
			background: #007bff;
			border: none;
			height: 45px;
			transition: background 0.3s;
		}

		.btn-primary:hover {
			background: #0056b3;
		}

		.alert {
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6">
					<div class="wrap">
						<h3 class="mb-4">@lang('lang.title_login')</h3>
						<form action="admin/login" method="POST">
							@csrf
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
							@if (session('canhbao'))
							<div class="alert alert-danger">
								{{ session('canhbao') }}
							</div>
							@endif
							<div class="form-group mb-3">
								<label class="label" for="name">@lang('lang.username')</label>
								<input type="text" name="username" class="form-control" placeholder="">
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">@lang('lang.password')</label>
								<input type="password" name="password" class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">@lang('lang.sign_in')</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>