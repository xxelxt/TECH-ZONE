<div class="card">
  <div class="card-body">
    <div class="d-flex flex-column align-items-center text-center">
      <img src="upload/avatar/{{ $user['image'] ?? 'avatar.jpg' }}" alt="Admin" class="rounded-circle" width="200px">

      <div class="mt-3">
        <h4>{{ $user['username'] }}</h4>
        @foreach($user['roles'] as $role)
        <p class="text-secondary mb-1">@lang('lang.role'): {{ $role['name'] }}</p>
        @endforeach
        <p class="text-muted font-size-sm">@lang('lang.amount_permission'): {{ $user['permissions']->count() }}</p>
      </div>
    </div>

    <div class="d-flex flex-column mt-3">
      {{-- Form to Change Image --}}
      <form action="admin/editimg" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="row">
          <div class="col-md-2">
            <label for="Image">@lang('lang.new_profile_image'):</label>
          </div>
          <div class="col-md-8">
            <input type="file" name="Image" id="Image" class="form-control" required>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-danger bg-gradient">@lang('lang.submit')</button>
          </div>
        </div>
      </form>

      {{-- Form to Edit Facebook --}}
      <form action="admin/edit_facebook" method="POST" class="mb-3">
        @csrf
        <div class="row">
          <div class="col-md-2">
            <h6>@lang('lang.social_network'):</h6>
          </div>
          <div class="col-md-8">
            <input type="text" value="{{ $user['facebook'] }}" class="form-control text-secondary" name="facebook" maxlength="191" required>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-danger bg-gradient">@lang('lang.submit')</button>
          </div>
        </div>
      </form>

      {{-- My Permissions Panel --}}
      <div class="panel ps-3">
        <div class="panel-heading">
          <h6 style="margin-top: 15px;">@lang('lang.permission_list'):</h6>
        </div>
        <div class="panel-body d-flex flex-wrap">
          @foreach($user['permissions'] as $per)
          <div class="label label-{{ $per['id'] % 3 == 0 ? 'info' : ($per['id'] % 2 == 0 ? 'primary' : 'success') }} bg-gradient mr-2 mb-2 lh15">{{ $per['name'] }}</div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>