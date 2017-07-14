@extends('templates.default')

@section('content')

<div class="row">
  <div class="col-sm-12 col-md-6 col-lg-4 offset-lg-1">

  <h1> Your friends </h1>
  <p> Here you can find list of all of your friends. </p>

    @if (!$friends->count())

     <p class="text-danger"><b> Sorry, but you have no friends yet. Search and add one.</b></p>
     <div class="text-xs-center">
       <i class="fa fa-3x fa-lg fa-frown-o" aria-hidden="true"></i>
     </div>

    @else
      @foreach ($friends as $user)
        @include('user/partials/friend-block')
      @endforeach
    @endif

  </div>
  <div class="col-sm-12 col-md-6 col-lg-4 offset-lg-1">

    <h1> Your friend Requests </h1>
    <p> View the profile of user and then accept request if you want. </p>

      @if(!$requests->count())

        <p class="text-danger"><b> It looks like you don't have any friend request yet. </b></p>
        <div class="text-xs-center">
          <i class="fa fa-3x fa-lg fa-frown-o" aria-hidden="true"></i>
        </div>

      @else

        @foreach ($requests as $user)
          @include ('user/partials/friend-block')
        @endforeach

      @endif

  </div>
</div>

@stop
