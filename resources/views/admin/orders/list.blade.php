@extends('admin.layout.index')
@section('content')
@can('list orders')
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
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.orders')</h1> {{-- Sử dụng @lang để hỗ trợ đa ngôn ngữ --}}
            <p class="text-muted">@lang('lang.list')</p>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <div class="table-responsive">
        <table id="autofill" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>@lang('lang.customer')</th>
                    <th>Email</th>
                    <th>@lang('lang.phone')</th>
                    <th>@lang('lang.address')</th>
                    <th>@lang('lang.district')</th>
                    <th>@lang('lang.total_price')</th>
                    <th>@lang('lang.status')</th>
                    <th>@lang('lang.update')</th>
                    @can('edit orders')
                    <th>@lang('lang.billing_details')</th>
                    @endcan
                    @can('delete orders')
                    <th>@lang('lang.delete')</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $value)
                <tr align="center">
                    <td>{!! $value['id'] !!}</td>
                    <td>{!! $value['users']['lastname'] !!} {!! $value['users']['firstname'] !!}</td>
                    <td>{!! $value['users']['email'] !!}</td>
                    <td>{!! $value['phone'] !!}</td>
                    <td>{!! $value['address'] !!}</td>
                    <td>{!! $value['district'] !!}</td>
                    <td>{!! number_format($value['total'])!!} đ</td>

                    {{-- Form để cập nhật trạng thái đơn hàng --}}
                    <form action="admin/orders/update/{!! $value['id'] !!}" method="POST">
                        @csrf
                        <td>
                            <div class="form-group">
                                <select name="status" style="text-align: center;">
                                    <option @if($value['status']==1) {!! 'selected' !!} @endif value="1" class="text-warning">@lang('lang.processing')</option>
                                    <option @if($value['status']==2) {!! 'selected' !!} @endif value="2" class="text-primary">@lang('lang.delivery')</option>
                                    <option @if($value['status']==3) {!! 'selected' !!} @endif value="3" class="text-success">@lang('lang.success')</option>
                                    <option @if($value['status']==4) {!! 'selected' !!} @endif value="4" class="text-danger">@lang('lang.denied')</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="payment_status" style="text-align: center;">
                                    <option @if($value['payment_status']==1) {!! 'selected' !!} @endif value="1" class="text-warning">@lang('lang.unpaid')</option>
                                    <option @if($value['payment_status']==2) {!! 'selected' !!} @endif value="2" class="text-success">@lang('lang.paid')</option>
                                </select>
                            </div>
                        </td>
                        <td><button type="submit" class="btn btn-success">@lang('lang.update')</button></td>
                    </form>

                    @can('edit orders')
                    <td><a class="btn btn-primary" href="admin/orders/details/{!! $value['id'] !!}">@lang('lang.billing_details_short')</a></td>
                    @endcan
                    @can('delete orders')
                    <td><a href="javascript:void(0)" class="btn btn-danger delete-orders" data-url="{{ url('ajax/delete_orders', $value['id'] ) }}">@lang('lang.delete')</a></td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else
<h1 align="center">@lang('lang.deny')</h1>
@endcan
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-orders').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") == true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        if (data['success']) {
                            // alert(data.success);
                            trObj.parents("tr").remove();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }

        });
    });
</script>
@endsection
@endsection