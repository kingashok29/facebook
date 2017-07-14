@extends('templates.default')

@section('content')

  <div class="row">
    <div class="col-lg-6 offset-lg-3 col-md-8 offset-lg-2 col-sm-12">

      <h1 class="text-xs-center" style="margin-top:5%;"> Oops </h1>
      <h3 class="text-xs-center"> This page could not be found. </h3>
      <br>
      <ul>
        <li> You are trying to acces which is now removed or deleted from server. </li>
        <li> You are trying to access the page which require login </li>
        <li> Please browse other pages, go back to
          <a style="text-decoration:underline;" href="{{ route('home') }}">home page.</a> or
          <a style="text-decoration:underline;" href="{{ route('auth.signin') }}"> login </a>
        </li>
      </ul>



    </div>
  </div>

@stop
