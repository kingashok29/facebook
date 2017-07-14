@extends('templates.default')

@section('content')

<div class="row">
  <div class="col-lg-6 offset-2 col-md-10 offset-md-1 col-sm-12">

   <h2 class="text-xs-center"> Search result for "{{ Request::input('query') }}" </h2><br>

      @if(!$users->count())
            <p class="text-danger"> Sorry, no results found. </p>
        @else
        @foreach ($users as $user)
          @include('user/partials/search-block')
        @endforeach
      @endif
  </div>
</div>
@stop
