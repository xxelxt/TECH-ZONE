@extends('user.layout.index')
@section('content')
@include('user.layout.menu_product')
<div class="container">
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">@lang('lang.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('lang.profile')</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <div class="row gutters-sm" style="margin: 35px auto 50px auto;">
            <div class="col-md-4 mb-3">
                <div class="card" style="border: none;">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if(isset($user['image']))
                            <img src="upload/avatar/{!! $user['image'] !!}" alt="Admin" class="rounded-circle" width="200px">
                            @else
                            <img src="upload/avatar/avatar.jpg" alt="Admin" class="rounded-circle" width="200px">
                            @endif
                            <div class="mt-3">
                                <h4>{!! $user['username'] !!}</h4>

                                <form action="/editimg_user" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mt-3">
                                        <input type="file" name="Image" class="form-control" style="margin-right: 5px;">
                                        <button type="submit" class="btn btn-danger bg-gradient">@lang('lang.submit')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="/edit_profile" method="POST">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">@lang('lang.fristname')</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="{!! $user['firstname'] !!}" class="form-control" name="firstname" placeholder="">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">@lang('lang.lastname')</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="{!! $user['lastname'] !!}" class="form-control" name="lastname" placeholder="">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="{!! $user['email'] !!}" class="form-control" name="email" placeholder="">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">@lang('lang.phone')</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="phone" value="{!! $user['phone'] !!}" class="form-control" name="phone" placeholder="">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">@lang('lang.joining_date')</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {!! date("d-m-Y H:m:s", strtotime($user['created_at'])) !!}
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="checkbox" id="checkChangpasswordprofile" name="changepasswordprofile">
                                    <label for="checkChangpasswordprofile">@lang('lang.change_password')</label>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">@lang('lang.newpass')</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" class="password form-control" name="password" disabled placeholder="" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">@lang('lang.confirm_newpass')</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" class="password form-control" name="passwordagain" disabled placeholder="" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary bg-gradient " target="__blank">@lang('lang.update')</button>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#checkChangpasswordprofile').change(function() {
            if ($(this).is(":checked")) {
                $('.password').removeAttr('disabled');
            } else {
                $('.password').attr('disabled', '');
            }
        });
    });
</script>
<script>
    totalWishlist();

    function totalWishlist() {
        $.ajax({
            type: 'GET',
            url: '/total_wishlist',
            success: function(response) {
                var response = JSON.parse(response);
                $('.total_wishlist').text(response);
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.wishlist').click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var users_id = "{!! Auth::id() !!}";
            var products_id = $(this).data('productid');
            $.ajax({
                type: 'POST',
                url: '/wishlist',
                data: {
                    products_id: products_id,
                    users_id: users_id
                },
                success: function(response) {
                    if (response.action == 'add') {
                        totalWishlist();
                        $('a[data-productid=' + products_id + ']').html('<i class="fas fa-heart"></i>');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'green');
                        $('#notifDiv').text(response.message);
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    } else if (response.action == 'remove') {
                        totalWishlist();
                        $('a[data-productid=' + products_id + ']').html('<i class="far fa-heart"></i>');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text(response.message);
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                }
            });
        });
    });
</script>
@endsection