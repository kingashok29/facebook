@extends('templates.default')

@section('content')

<div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-sm-10 offset-sm-1">
    
    <h1 class="text-xs-center"> Signup for an account </h1>
      <p class="text-xs-center help-block"> Fill the form below and submit, Signing up for an account on our website is completely free. </p>

        <form action=" {{ route('auth.signup') }} " method="post">
          <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
            <label for="email" class="col-form-label">Your email address:</label>
            <input type="text" class="form-control form-control-danger" name="email" id="email" value="{{ Request::old('email') ?: '' }}" placeholder="Enter email">

            @if ($errors->has('email'))
              <div class="form-control-feedback"> {{ $errors->first('email') }} </div>
            @endif

          </div>

          <div class="form-group {{ $errors->has('username') ? 'has-danger' : '' }}">
            <label for="username" class="col-form-label">Choose an username:</label>
            <input type="text" class="form-control form-control-danger" name="username" id="username" value="{{ Request::old('username') ?: '' }}" placeholder="Enter username">

            @if ($errors->has('username'))
              <div class="form-control-feedback"> {{ $errors->first('username') }} </div>
            @endif

          </div>

          <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
            <label for="password" class="col-form-label">Password:</label>
            <input type="password" class="form-control form-control-danger" name="password" id="password" placeholder="Enter your password" value="{{ Request::old('password') ?: '' }}">

            @if ($errors->has('password'))
              <div class="form-control-feedback"> {{ $errors->first('password') }} </div>
            @endif

          </div>

          <div class="form-group {{ $errors->has('agree') ? 'has-danger' : '' }}">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="agree" value="yes"@if (Request::old('agree') == "yes") checked @endif>
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">I agree with Terms &amp; Conditions of Earnm.in</span>
            </label>
            @if($errors->has('agree'))
              <div class="form-control-feedback"> {{ $errors->first('agree') }} </div>
            @endif
          </div>

          <button type="submit" class="btn btn-success">Signup for an account!</button>
          <input type="hidden" name="_token" value="{{ Session::token()}}">

        </form>

        </div>
      </div>

@stop
