@extends('templates.default')
@section('content')

<div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-sm-10 offset-sm-1">

      <h1 class="text-xs-center"> Reset password </h1>

      <form action="{{ route('password.reset-password') }}" method="post">

        <div class="form-group">
          <label for="email" class="col-form-label"> Email address: </label>
          <input type="text" class="form-control form-control-danger" value="" name="email" disabled>
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
          <label for="password" class="col-form-label"> New password: </label>
          <input type="password" class="form-control form-control-danger" name="password" value="{{ Request::old('password') ?: '' }}">

          @if ($errors->has('password'))
            <div class="form-control-feedback"> {{ $errors->first('password') }} </div>
          @endif

        </div>

        <div class="form-group {{ $errors->has('confirm_password') ? 'has-danger' : '' }}">
          <label for="confirm_password" class="col-form-label"> Confirm new password: </label>
          <input type="password" class="form-control form-control-danger" name="confirm_password" value="{{ Request::old('confirm_password') ?: '' }}">

          @if ($errors->has('confirm_password'))
            <div class="form-control-feedback"> {{ $errors->first('confirm_password') }} </div>
          @endif

        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-md btn-primary" value="Save new password">
        </div>

        {{ csrf_field() }}
      </form>

    </div>
  </div>

@stop
