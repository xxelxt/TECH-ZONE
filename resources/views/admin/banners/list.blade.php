@extends('admin.layout.index')
@section('content')
@can('list banners')

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
            <h1>@lang('lang.ban')</h1>
            <p class="text-muted">@lang('lang.list')</p>
        </div>
        <div class="col-auto">
            @can('add banners')
            <a href="admin/banners/create" class="btn btn-primary">
                @lang('lang.add')
            </a>
            @endcan
            @can('delete banners')
            <button class="btn btn-danger delete_all" data-url="{{ url('ajax/deleteall_banners') }}">
                @lang('lang.delete_all')
            </button>
            @endcan
        </div>

    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <div class="table-responsive">
        <table class="table table-bordered" style="width:100%">
            <thead>
                <tr align="center">
                    <th><input type="checkbox" id="master"></th>
                    <th>@lang('lang.image')</th>
                    <th>@lang('lang.active')</th>
                    @can('edit banners')
                    <th>@lang('lang.edit')</th>
                    @endcan
                    @can('delete banners')
                    <th>@lang('lang.delete')</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $value)
                <tr align="center">
                    <td><input type="checkbox" class="sub_chk" data-id="{!! $value['id'] !!}"></td>
                    <td>
                        <img width="100px" src="user_asset/images/banners/{!! $value['image'] !!}" alt="">
                    </td>
                    <td>
                        <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{!! $value['id'] !!}" data-onstyle="primary" data-offstyle="danger" {!! $value['active']==true ? 'checked' : '' !!}>
                    </td>
                    @can('edit banners')
                    <td><a class="btn btn-warning" href="admin/banners/edit/{!! $value['id'] !!}">@lang('lang.edit')</a></td>
                    @endcan
                    @can('delete banners')
                    <td><a href="javascript:void(0)" data-url="{{ url('ajax/delete_banners', $value['id'] ) }}" class="btn btn-danger delete-banners">@lang('lang.delete')</a></td>
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
    //active
    $('.toggle-class').on('change', function() {
        var active = $(this).prop('checked') == true ? 1 : 0;
        var ban_id = $(this).data('id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'ajax/active_banners',
            data: {
                'active': active,
                'ban_id': ban_id
            },
        });
    });

    //deleteall ajax 
    $(document).ready(function() {
        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                var check = confirm("Are you sure you want to delete this row?");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                // alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });
    });

    //delete ajax 
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-banners').on('click', function() {
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