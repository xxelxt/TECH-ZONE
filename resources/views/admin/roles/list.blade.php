@extends('admin.layout.index')
@section('content')
@role('admin')
    <div class="card" style="border: none; margin: 30px;">
        <div class="row align-items-center">
            <div class="col">
                <h1>@lang('lang.role')</h1>
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
                        <th>@lang('lang.role')</th>
                        <th>@lang('lang.created')</th>
                        <th>@lang('lang.updated')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $value)
                        <tr align="center">
                            <td>{!! $value['id'] !!}</td>
                            <td>{!! $value['name'] !!}</td>
                            <td>{!! $value['created_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                            <td>{!! $value['updated_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <h1 align="center">@lang('lang.deny')</h1>
@endrole
@endsection