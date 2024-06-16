@extends('admin.layout.index')
@section('content')
<style>
  .card {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
  }

  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
  }

  .card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
  }

  .gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
  }

  .gutters-sm>.col,
  .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
  }

  .mb-3,
  .my-3 {
    margin-bottom: 1rem !important;
  }

  .bg-gray-300 {
    background-color: #e2e8f0;
  }

  .h-100 {
    height: 100% !important;
  }

  .shadow-none {
    box-shadow: none !important;
  }

  @media (min-width: 1200px) {
    .container {
      max-width: 2000px;
    }
  }
</style>
@if ($user != null)
<div class="container">
  <div class="main-body">
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        @include('admin.user_profile.user_card')
      </div>

      <div class="col-md-8">
        @include('admin.user_profile.edit_form')
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#checkChangpasswordprofile').change(function() {
      if ($(this).is(":checked")) {
        $('.password').removeAttr('disabled');
      } else {
        $('.password').attr('disabled', '');
      }
    });
  });
</script>
@endsection