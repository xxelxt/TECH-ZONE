@extends('admin.layout.index')

@section('content')
    <div class="card" style="border: none; margin: 30px;">
        <div class="row align-items-center">
            <div class="col">
                <h1>@lang('lang.products')</h1>
                <p class="text-muted">@lang('lang.add')</p>
            </div>
        </div>
    </div>

    <div class="card" style="border: none; margin: 30px;">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $arr)
                        {{$arr}}<br>
                    @endforeach
                </div>
            @endif
            @if (session('thongbao'))
                <div class="alert alert-success">
                    {{ session('thongbao') }}
                </div>
            @endif

            <form action="admin/products/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.cate')</label>
                    <div class="col-md-11">
                        <select name="categories_id" class="form-control" id="category">
                            @foreach ($categories as $value)
                                @if($value['active'] == 1)
                                    <option value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.sub')</label>
                    <div class="col-md-11">
                        <select name="sub_id" class="form-control" id="subcategory">
                            @foreach ($subcategories as $value)
                                @if($value['active'] == 1)
                                    <option value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.brands')</label>
                    <div class="col-md-11">
                        <select name="brands_id" class="form-control">
                            @foreach ($brands as $value)
                                @if($value['active'] == 1)
                                    <option value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.name')</label>
                    <div class="col-md-11">
                        <input class="form-control" name="name" placeholder="@lang('lang.enter') @lang('lang.name')" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.image')</label>
                    <div class="col-md-11">
                        <input type='file' name='Image' class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.image_library')</label>
                    <div class="col-md-11">
                        <input type='file' name='Imagelibrary[]' class="form-control" multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">Video</label>
                    <div class="col-md-11">
                        <input class="form-control" id="link" name="link" placeholder="https://www.youtube.com/watch?v=" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.size')</label>
                    <div class="col-md-11">
                        <input class="form-control" name="size" placeholder="@lang('lang.enter') @lang('lang.size')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.quanty')</label>
                    <div class="col-md-11">
                        <input class="form-control" type="number" name="quantity" placeholder="@lang('lang.enter') @lang('lang.quanty')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.price')</label>
                    <div class="col-md-11">
                        <input class="form-control" type="number" name="price" placeholder="@lang('lang.enter') @lang('lang.price')" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-1">
                        <input type="checkbox" id="checkPrice" name="changeprice">
                        <label for="checkPrice" class="form-check-label">@lang('lang.new_price')</label>
                    </div>
                    <div class="col-md-11">
                        <input class="price_new form-control" type="number" name="price_new" disabled placeholder="@lang('lang.enter') @lang('lang.new_price')" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.content')</label>
                    <div class="col-md-11">
                        <textarea class="form-control" name="content" id="editor" placeholder="@lang('lang.enter') @lang('lang.content')"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.featured_product')</label>
                    <div class="col-md-11 mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="featured_product" value="1" checked>
                            <label class="form-check-label">@lang('lang.yes')</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="featured_product" value="0">
                            <label class="form-check-label">@lang('lang.no')</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-1 col-form-label">@lang('lang.active')</label>
                    <div class="col-md-11 mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="active" value="1" checked>
                            <label class="form-check-label">@lang('lang.yes')</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="active" value="0">
                            <label class="form-check-label">@lang('lang.no')</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-11 offset-md-1">
                        <button type="submit" class="btn btn-primary m-b-0">@lang('lang.add')</button>
                    </div>
                </div>
            </form>
    </div>
@endsection


@section('script')
<script>
     $(document).ready(function(){
        $("#category").change(function(){
            var cat_id = $(this).val();
            $.get("ajax/Subcategories/"+cat_id,function(data){
                $("#subcategory").html(data);
            });
        });
    });
</script>
<script>
        $(document).ready(function(){
            $('#checkPrice').change(function(){
            if($(this).is(":checked"))
            {
                $('.price_new').removeAttr('disabled');
            }
            else 
                {
                 $('.price_new').attr('disabled','');
                 }
            });
        });
    </script>
@endsection

