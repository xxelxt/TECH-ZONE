@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.staff')</h1>
            <p class="text-muted">@lang('lang.edit') @lang('lang.permission'): {!! $user['username'] !!}</p> 
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
    <div class="card-body">
        @if(count($errors)>0)
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

        <form action="admin/staff/permission/{!! $user['id'] !!}" method="POST">
            @csrf
            <div class="row">
                @foreach($permission as $permis)
                    <div class="col-md-3 form-check">
                        <input class="form-check-input" type="checkbox"
                            @foreach($user_per as $pr)
                                @if($pr['id'] == $permis['id'])
                                    checked
                                @endif
                            @endforeach
                            name="permission[]" value="{!! $permis['name'] !!}" id="{!! $permis['id'] !!}">
                        <label class="form-check-label" for="{!! $permis['id'] !!}">
                            {!! $permis['name'] !!}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="row mb-3 mt-3">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-warning m-b-0" onclick='selects()' value="Select All">@lang('lang.select_all')</button>
                    <button type="button" class="btn btn-danger m-b-0" onclick='unselects()' value="Select All">@lang('lang.unselect_all')</button>
                    <button type="submit" class="btn btn-primary m-b-0">@lang('lang.update')</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    function selects() {
        var ele = document.getElementsByName('permission[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = true;
        }
    }
    function unselects() {
        var ele = document.getElementsByName('permission[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = false;
        }
    }
</script>
@endsection