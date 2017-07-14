@extends('templates.default')

@section('content')

<div class="row">
  <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">

      <h1 class="text-xs-center"> Welcome to Earnm.in <br><small> Awesome social media site for everyone </small></h1>
      <ul style="list-item-style:circle; font-size:1.2em;">
        <li>Post status</li>
        <li>Posting images/articles/videos</li>
        <li>Connecting with other peoples from around the world.</li>
        <li>Liking status</li>
        <li>Earning money from your content.</li>
      </ul>
<div class="text-xs-center">
      <a href="{{ route('auth.signup') }}" role="button" class="text-center btn btn-md btn-primary"> Signup for an account </a>
      <a href="{{ route('auth.signin') }}" role="button" class="text-center btn btn-md btn-success"> Login to account </a>
</div>
    </div>
  </div>

@stop
