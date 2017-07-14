@extends('templates.default')

@section('content')
@include('profile.partial')

    <form action="{{ route('edit.profile-info') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

      <div class="form-group col-lg-12 {{ $errors->has('profile_pic') ? 'has-danger' : '' }}">
        <label for="profile" class="col-form-label">Upload profile picture</label>
        <input type="file" name="profile_pic" class="form-control form-control-danger" value="{{ Request::old('profile_pic') ?: Auth::user()->profile_pic }}">

        @if($errors->has('profile_pic'))
          <div class="form-control-feedback">{{ $errors->first('profile_pic') }}</div>
        @endif
      </div>

      <div class="form-group col-lg-12 {{ $errors->has('cover_pic') ? 'has-danger' : '' }}">
        <label for="cover" class="col-form-label">Upload cover picture</label>
        <input type="file" name="cover_pic" class="form-control form-control-danger" value="{{ Request::old('cover_pic') ?: Auth::user()->cover_pic }}">

        @if($errors->has('cover_pic'))
          <div class="form-control-feedback">{{ $errors->first('cover_pic') }}</div>
        @endif
      </div>

      <div class="form-group col-lg-12">
        <div class="text-muted">Image must be your own and less then 2MB in size and format of
          image must be .jpg, .png &amp; .jpeg only.</div>
      </div>

      <div class="form-group col-lg-12">
        <button type="submit" class="btn btn-primary"> Update profile picture </button>
        {{ csrf_field() }}
      </div>

    </form>

  </div>
</div>

@stop
