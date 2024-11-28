@extends('admin.layout.index')

@section('content')
@can('list category')
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
            <h1>@lang('lang.cate')</h1>
            <p class="text-muted">@lang('lang.list')</p>
        </div>

        <div class="col-auto">
            @can('add category')
            <a href="admin/categories/create" class="btn btn-primary">
                @lang('lang.add')
            </a>
            @endcan
            @can('delete category')
            <button class="btn btn-danger delete_all" data-url="{{ url('ajax/deleteall_categories') }}">
                @lang('lang.delete_all')
            </button>
            @endcan
        </div>
        <form action="{{ route('admin.categories.list') }}" method="GET">
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
                    <th><input type="checkbox" id="master"></th>
                    <th>@lang('lang.cate')</th>
                    <th>@lang('lang.created')</th>
                    <th>@lang('lang.updated')</th>
                    @can('add category')
                    <th>@lang('lang.active')</th>
                    @endcan
                    @can('edit category')
                    <th>@lang('lang.edit')</th>
                    @endcan
                    @can('delete category')
                    <th>@lang('lang.delete')</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="memberBody">
                @foreach($categories as $value)
                <tr align="center">
                    <td><input type="checkbox" class="sub_chk" data-id="{!! $value['id'] !!}"></td>
                    <td>{!! $value['name'] !!}</td>
                    <td>{!! $value['created_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                    <td>{!! $value['updated_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                    @can('add category')
                    <td>
                        <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{!! $value['id'] !!}" data-onstyle="primary" data-offstyle="danger" {!! $value['active']==true ? 'checked' : '' !!}>
                    </td>
                    @endcan
                    @can('edit category')
                    <td>
                        <a href="admin/categories/edit/{!! $value['id'] !!}" class="btn btn-warning ">@lang('lang.edit')</a>
                    </td>
                    @endcan
                    @can('delete category')
                    <td>
                        <a href="javascript:void(0)" data-url="{{ url('ajax/delete_categories', $value['id'] ) }}" class="btn btn-danger delete-categories"> @lang('lang.delete')</a>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $categories->links() !!}
    </div>
</div>

@else
<h1 align="center">@lang('lang.deny')</h1>
@endcan
@section('script')
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#addForm').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type : 'POST',
                url:url,
                data: form,
                dataType: 'JSON',
                success:function() {
                    $('#add').modal('hide');
                    $('#addForm')[0].reset();
                    showMember();
                }
            })
        });
    });
    function showMember()
    {
            // $('#memberBody').empty().html(data);
            var table = document.getElementById('memberBody');
            var tr = document.createElement('tr');
            
            var html = 
            tr.innerHTML = html;
            table.appendChild(tr);
    }
</script> -->
<script>
    //active ajax
    $('.toggle-class').on('change', function() {
        var active = $(this).prop('checked') == true ? 1 : 0;
        var cate_id = $(this).data('id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'ajax/active_cate',
            data: {
                'active': active,
                'cate_id': cate_id
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
        $('.delete-categories').on('click', function() {
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