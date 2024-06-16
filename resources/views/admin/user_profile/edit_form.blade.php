<div class="card mb-3">
  <div class="card-body">
    <div class="card-block">
      @if(count($errors)>0)
      <div class="alert alert-danger">
        @foreach($errors->all() as $arr)
        {{ $arr }}<br>
        @endforeach
      </div>

      <hr>
    </div>
    @endif
    <form action="admin/edit" method="POST">
      @csrf
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.fristname')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="text" value="{!! $user['firstname'] !!}" class="form-control" name="firstname" placeholder="">
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.lastname')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="text" value="{!! $user['lastname'] !!}" class="form-control" name="lastname" placeholder="">
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">Email</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="text" value="{!! $user['email'] !!}" class="form-control" name="email" placeholder="">
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.phone')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="phone" value="{!! $user['phone'] !!}" class="form-control" name="phone" placeholder="">
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.joining_date')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {!! date("d-m-Y H:m:s", strtotime($user['created_at'])) !!}
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="checkbox" id="checkChangpasswordprofile" name="changepasswordprofile">
          <label for="checkChangpasswordprofile">@lang('lang.change_password')</label>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.password')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="password" class="password form-control" name="password" disabled placeholder="" />
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.password_again')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="password" class="password form-control" name="passwordagain" disabled placeholder="" />
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary bg-gradient " target="__blank">@lang('lang.update')</button>
        </div>
      </div>
    </form>
  </div>
</div>