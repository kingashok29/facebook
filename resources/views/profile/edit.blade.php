@extends('templates.default')

@section('content')

@include('profile.partial')

  <div class="panel panel-default col-lg-offset-3 col-lg-6">
    <div class="panel-body">
      <form action=" {{ route('edit.basic') }} " method="post">

      <div class="form-group col-lg-6 {{ $errors->has('first_name') ? 'has-error' : '' }}">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">

        @if ($errors->has('first_name'))
          <span class="help-block"> {{ $errors->first('first_name') }} </span>
        @endif

      </div>

      <div class="form-group col-lg-6 {{ $errors->has('last_name') ? 'has-error' : '' }}">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">

        @if ($errors->has('last_name'))
          <span class="help-block"> {{ $errors->first('last_name') }} </span>
        @endif

      </div>

      <div class="form-group col-lg-12 {{ $errors->has('email') ? 'has-error' : '' }}">
        <label for="email">Email Address:</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ Request::old('email')
        ?: Auth::user()->email }}">

        @if ($errors->has('email'))
          <span class="help-block"> {{ $errors->first('email') }} </span>
        @endif

      </div>

      <div class="form-group col-lg-12 {{ $errors->has('location') ? 'has-error' : '' }}">
        <label for="location">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="{{ Request::old('location') ?: Auth::user()->location }}">

        @if ($errors->has('location'))
          <span class="help-block"> {{ $errors->first('location') }} </span>
        @endif

      </div>


      <button type="submit" class="btn btn-success">Update my profile!</button>
      <input type="hidden" name="_token" value="{{ Session::token()}}">


    </form>
    </div>
  </div>

@stop
