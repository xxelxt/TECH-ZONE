<div class="card mb-3">
  <div class="card-body">
    <div class="card-block">
    </div>
    <form action="admin/edit" method="POST">
      @csrf
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.fristname')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="text" value="{!! $user['firstname'] !!}" class="form-control" name="firstname" placeholder="" maxlength="191" required>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.lastname')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="text" value="{!! $user['lastname'] !!}" class="form-control" name="lastname" placeholder="" maxlength="191" required>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">Email</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="text" value="{!! $user['email'] !!}" class="form-control" name="email" placeholder="" maxlength="191" required>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.phone')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="phone" value="{!! $user['phone'] !!}" class="form-control" name="phone" placeholder="" min="0" step="1" maxlength="13" required>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.joining_date')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {!! $user['created_at']->timezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s') !!}
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
          <h6 class="mb-0">@lang('lang.newpass')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="password" class="password form-control" name="password" disabled placeholder="" maxlength="30"/>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <h6 class="mb-0">@lang('lang.confirm_newpass')</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <input type="password" class="password form-control" name="passwordagain" disabled placeholder="" maxlength="30"/>
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