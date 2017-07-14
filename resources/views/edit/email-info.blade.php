@extends('templates.default')

@section('content')
@include('profile.partial')

    <form action="{{ route('edit.email-info') }}" class="form-horizontal" method="post">

      <div class="form-group col-lg-12 {{ $errors->has('email') ? 'has-danger' : '' }}">
        <label for="email" class="form-control-label">Email address: </label>
        <input type="text" name="email" class="form-control form-control-danger" value="{{ Request::old('email') ?: Auth::user()->email }}">

          @if ($errors->has('email'))
            <div class="form-control-feedback"> {{ $errors->first('email') }} </div>
          @endif
        </div>

      <div class="form-group col-lg-12 {{ $errors->has('password') ? 'has-danger' : '' }}">
        <label for="password" class="form-control-label">Update password</label>
        <input type="password" name="password" class="form-control form-control-danger"
        value="{{ Request::old('password') ?: Auth::user()->password }}">

          @if ($errors->has('password'))
            <div class="form-control-feedback">{{ $errors->first('password') }} </div>
          @endif
      </div>

      <div class="form-group col-lg-12">
        <span class="help-block">Fill email &amp; password field to update info else leave empty. </span>
      </div>

      <div class="form-group col-lg-12">
        <button type="submit" class="btn btn-primary"> Update info </button>
        {{ csrf_field() }}
      </div>

    </form>

  </div>
</div>

@stop
