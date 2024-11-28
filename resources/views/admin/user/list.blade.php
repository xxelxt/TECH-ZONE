@extends('admin.layout.index')
@section('content')
@can('list users')
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
            <h1>@lang('lang.user')</h1>
            <p class="text-muted">@lang('lang.list')</p>
        </div>
        <form action="{{ route('admin.users.list') }}" method="GET">
            <div class="input-group" style="margin-top: 20px; margin-right: 200px; padding-right: 15px;">
                <input type="text" class="form-control" name="search" placeholder="@lang('lang.search')" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">@lang('lang.search')</button>
            </div>
        </form>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <div class="table-responsive">
        <table id="autofill" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>@lang('lang.name')</th>
                    <th>@lang('lang.username')</th>
                    <th>Email</th>
                    <th>@lang('lang.created')</th>
                    <th>@lang('lang.updated')</th>
                    @can('delete users')
                    <th>@lang('lang.active')</th>
                    <th>@lang('lang.delete')</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($users as $value)
                @foreach($value['roles'] as $role)
                @if($role['name'] == 'user')
                <tr align="center">
                    <td>{!! $value['id'] !!}</td>
                    <td>{!! $value['lastname'] !!} {!! $value['firstname'] !!}</td>
                    <td>{!! $value['username'] !!}</td>
                    <td>{!! $value['email'] !!}</td>
                    <td>{!! $value['created_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                    <td>{!! $value['updated_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                    @can('delete users')
                    <td>
                        <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{!! $value['id'] !!}" data-onstyle="primary" data-offstyle="danger" {!! $value['active']==true ? 'checked' : '' !!}>
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-url="{{ url('ajax/delete_staff', $value['id'] ) }}" class="btn btn-danger delete-user">@lang('lang.delete')</a>
                    </td>
                    @endcan
                </tr>
                @endif
                @endforeach
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
    $('.toggle-class').on('change', function() {
        var active = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'ajax/active_user',
            data: {
                'active': active,
                'user_id': user_id
            },
        });
    });

    //delete ajax
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-user').on('click', function() {
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