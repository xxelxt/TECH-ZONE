@extends('admin.layout.index')
@section('content')
@role('admin')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.staff')</h1>
            <p class="text-muted">@lang('lang.list')</p>
        </div>
        <div class="col-auto">
            <a href="admin/staff/create" class="btn btn-primary">
                @lang('lang.add')
            </a>
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <div class="table-responsive">
        <table id="autofill" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>@lang('lang.staff')</th>
                    <th>Email</th>
                    <th>@lang('lang.role')</th>
                    <th>@lang('lang.created')</th>
                    <th>@lang('lang.updated')</th>
                    <th>@lang('lang.active')</th>
                    <th>@lang('lang.edit') @lang('lang.role')</th>
                    <th>@lang('lang.edit') @lang('lang.permission')</th>
                    <th>@lang('lang.edit') @lang('lang.info')</th>
                    <th>@lang('lang.delete')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $value)
                @foreach($value['roles'] as $role)
                @if($role['name'] == 'admin' || $role['name'] == 'staff' )
                <tr align="center">
                    <td>{!! $value['id'] !!}</td>
                    <td>{!! $value['username'] !!}</td>
                    <td>{!! $value['email'] !!}</td>
                    @foreach($value['roles'] as $role)
                    <td>
                        {!! $role['name'] !!}
                    </td>
                    @endforeach
                    <td>{!! date("d-m-Y H:m:s", strtotime($value['created_at'])) !!}</td>
                    <td>{!! date("d-m-Y H:m:s", strtotime($value['updated_at'])) !!}</td>
                    @if($value->hasRole('admin'))
                    <td>
                        <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{!! $value['id'] !!}" class="btn-check" data-onstyle="secondary" data-offstyle="danger" {!! $value['active']==true ? 'checked' : '' !!} disabled>
                    </td>
                    @else
                    <td>
                        <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{!! $value['id'] !!}" data-onstyle="primary" data-offstyle="danger" {!! $value['active']==true ? 'checked' : '' !!}>
                    </td>
                    @endif
                    <td><a class="btn btn-primary" href="admin/staff/role/{!! $value['id'] !!}">@lang('lang.role')</a></td>
                    <td><a class="btn btn-success" href="admin/staff/permission/{!! $value['id'] !!}">@lang('lang.permission')</a></td>
                    <td><a class="btn btn-warning" href="admin/staff/edit/{!! $value['id'] !!}">@lang('lang.edit')</a></td>
                    <td><a href="javascript:void(0)" data-url="{{ url('ajax/delete_staff', $value['id'] ) }}" class="btn btn-danger delete-staff">@lang('lang.delete')</a></td>
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
@endrole
@section('script')
<script>
    //active
    $('.toggle-class').on('change', function() {
        var active = $(this).prop('checked') == true ? 1 : 0;
        var staff_id = $(this).data('id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'ajax/active_staff',
            data: {
                'active': active,
                'staff_id': staff_id
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
        $('.delete-staff').on('click', function() {
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