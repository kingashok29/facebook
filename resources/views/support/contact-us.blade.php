@extends('templates.default')
@section('content')

    <div class="row">
      <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
        <h1> Contact support </h1>
        <p> We will reply back within few hours :) </p><br>

      </div>

      <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12">
        <form action="{{ route('support.contact-us') }}" method="post">
          <div class="form-group row {{ $errors->has('name') ? 'has-danger' : '' }}">
            <label for="name" class="col-xs-3 col-form-label">Your Name</label>
            <div class="col-xs-9">
                <input class="form-control form-control-danger" type="text"
                value="{{ Auth::check() ? Auth::user()->username : Request::old('email') }}"
                id="name" name="name" placeholder="Better to provide name."
                {{ Auth::check() ? 'readonly' : '' }}>
              <div class="form-control-feedback">{{ $errors->first('name') }}</div>
            </div>
          </div>

          <div class="form-group row {{ $errors->has('email') ? 'has-danger' : '' }}">
            <label for="email" class="col-xs-3 col-form-label">Email Address</label>
            <div class="col-xs-9">
              <input class="form-control form-control-danger" type="text"
              value="{{ Auth::check() ? Auth::user()->email : Request::old('email') }}"
              name="email" id="email" placeholder="Where we reply back."
              {{ Auth::check() ? 'readonly' : '' }}>
              <div class="form-control-feedback">{{ $errors->first('email') }}</div>
            </div>
          </div>

          <div class="form-group row {{ $errors->has('message') ? 'has-danger' : '' }}">
            <label for="message" class="col-xs-3 col-form-label">Message</label>
            <div class="col-xs-9">
              <textarea class="form-control form-control-danger" rows="6" name="message" id="message" placeholder="Tell us about why you are contacting support and give as much possible info.">{{ Request::old('message') ?: '' }}</textarea>
              <div class="form-control-feedback">{{ $errors->first('message') }}</div>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-7 offset-xs-3">
              <input type="submit" value="Contact support" class="btn btn-primary btn-md">
            </div>
          </div>

          {{ csrf_field() }}

        </form><br>
      </div>

      </div>
    </div>

@stop
