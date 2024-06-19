@extends('admin.layout.index')
@section('content')
<div class="card" style="border: none; margin: 30px;">
    <div class="row align-items-center">
        <div class="col">
            <h1>@lang('lang.staff')</h1>
            <p class="text-muted">@lang('lang.edit') @lang('lang.role'): {!! $user['username'] !!}</p> 
        </div>
    </div>
</div>

<div class="card" style="border: none; margin: 30px;">
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

        <form action="admin/staff/role/{!! $user['id'] !!}" method="POST">
            @csrf
            @if(isset($all_role))
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.role')</label>
                    <div class="col-md-11">
                        <select name="role" class="form-control">
                            @foreach($role as $value)
                                <option @if ($value['id'] == $all_role['id']) selected @endif value="{!!$value['id']!!}">{!!$value['name']!!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-11 offset-md-1">
                    <button type="submit" class="btn btn-primary">@lang('lang.update') @lang('lang.role')</button>
                    <a class="btn btn-danger" href="{{ URL::previous() }}">@lang('lang.exit')</a> 
                </div>
            </div>
        </form>
    </div>
</div>
@endsection