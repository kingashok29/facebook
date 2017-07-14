@extends('templates.default')
@section('content')

<div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-sm-10 offset-sm-1">

      <h1 class="text-xs-center"> Forgotten password </h1>

      <span class="help-block">** Enter email which you registered while signup and we will send an
      unique link to your email address for reseting passwords. </span>

      <form action="{{ route('password.forgot-password') }}" method="post">

        <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
          <label for="email" class="col-form-label"> Email address: </label>
          <input type="text" class="form-control form-control-danger" value="{{ Request('old') ?: '' }}"
              placeholder="Enter your email address" name="email">

          @if ($errors->has('email'))
            <div class="form-control-feedback"> {{ $errors->first('email') }} </div>
          @endif

        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-md btn-primary" value="Send me link">
        </div>

        {{ csrf_field() }}
      </form>

@stop
