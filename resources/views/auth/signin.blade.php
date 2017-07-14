@extends('templates.default')

@section('content')

  <div class="row">
    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-sm-10 offset-sm-1">

      <h1 class="text-xs-center"> Login </h1>
        <p class="text-xs-center"> Fill the form below to log into your account. </p>

            <form action=" {{ route('auth.signin') }} " method="post">
            <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
              <label for="email" class="col-form-label">Your email address:</label>
              <input type="text" class="form-control form-control-danger" name="email" id="email" value="{{ Request::old('email') ?: '' }}" placeholder="Enter email">

              @if ($errors->has('email'))
                <div class="form-control-feedback"> {{ $errors->first('email') }} </div>
              @endif

            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
              <label for="password">Password:</label>
              <input type="password" class="form-control form-control-danger" name="password" id="password" placeholder="Enter password">

              @if ($errors->has('password'))
                <div class="form-control-feedback"> {{ $errors->first('password') }} </div>
              @endif

            </div>

            <div class="form-group">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" value="yes"@if (Request::old('remember') == "yes") checked @endif>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Remember my details for next time login.</span>
              </label>
            </div>

            <button type="submit" class="btn btn-success">Login</button>
            <a href="{{ url('/password/forgot-password') }}" class="btn btn-link pull-right"> Forgotten password? </a>
            <input type="hidden" name="_token" value="{{ Session::token()}}">
          </form>

      </div>
    </div>

@stop
