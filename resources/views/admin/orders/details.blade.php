@extends('admin.layout.index')
@section('content')
@can('list orders')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.order_detail')</h1>
            <p class="text-muted">@lang('lang.list')</p>
            <a href="admin/orders/list" class="btn btn-primary">
                @lang('lang.back_to') @lang('lang.orders')
            </a>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <div class="table-responsive">
        <table id="autofill" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th>@lang('lang.name_pro')</th>
                    <th>@lang('lang.image_product')</th>
                    <th>@lang('lang.quanty')</th>
                    <th>@lang('lang.price')</th>
                    <th>@lang('lang.created')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders_detail as $value)
                <tr align="center">
                    <td>{!! $value['name'] !!}</td>
                    <td><img style="width: 100px;" src="user_asset/images/products/{!! $value['image'] !!}" alt=""></td>
                    <td>{!! $value['quantity'] !!}</td>
                    <td>{!! number_format($value['price']) !!} đ</td>
                    <td>{!! $value['created_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else
<h1 align="center"> Không có quyền truy cập</h1>
@endcan
@endsection