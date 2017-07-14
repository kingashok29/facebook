@extends('templates.default')

@section('content')

@include('profile.partial')

      <form action=" {{ route('edit.basic') }} " method="post">

      <div class="form-group col-lg-6 {{ $errors->has('first_name') ? 'has-danger' : '' }}">
        <label for="first_name" class="col-form-label">First Name:</label>
        <input type="text" class="form-control form-control-danger" name="first_name" id="first_name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">

        @if ($errors->has('first_name'))
          <div class="form-control-feedback"> {{ $errors->first('first_name') }} </div>
        @endif

      </div>

      <div class="form-group col-lg-6 {{ $errors->has('last_name') ? 'has-danger' : '' }}">
        <label for="last_name" class="col-form-label">Last Name:</label>
        <input type="text" class="form-control form-control-danger" name="last_name" id="last_name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">

        @if ($errors->has('last_name'))
          <div class="form-control-feedback"> {{ $errors->first('last_name') }} </div>
        @endif

      </div>

      <div class="form-group col-lg-12 {{ $errors->has('about') ? 'has-danger' : '' }}">
        <label for="about" class="col-form-label">About me:</label>
        <input type="text" class="form-control form-control-danger" name="about" id="about" value="{{ Request::old('about') ?: Auth::user()->about }}">
        @if ($errors->has('about'))
          <div class="form-control-feedback"> {{ $errors->first('about') }} </div>
        @endif

      </div>

      <div class="form-group col-lg-12 {{ $errors->has('location') ? 'has-danger' : '' }}">
        <label for="location" class="col-form-label">Location:</label>
        <input type="text" class="form-control form-control-danger" name="location" id="location" value="{{ Request::old('location') ?: Auth::user()->location }}">

        @if ($errors->has('location'))
          <div class="form-control-feedback"> {{ $errors->first('location') }} </div>
        @endif

      </div>

      <div class="form-group col-lg-12">
        <p> You joined this site - <b> {{ Auth::user()->created_at->diffForHumans() }} </b></p>
      </div>

      <div class="form-group col-lg-12">
        <button type="submit" class="btn btn-primary">Update basic info</button>
        <input type="hidden" name="_token" value="{{ Session::token()}}">
      </div>


    </form>
    </div>
  </div>

@stop
