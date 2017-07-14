@extends('templates.default')
@section('content')

  <div class="row">
    <div class="col-lg-10 lg-offset-1 col-md-10 offset-md-1 col-sm-12">

      @if ($count === 0)
      <div class="text-xs-center" style="color:#8C999A; margin:10% auto;">
        <h3> No posts </h3>
        <span> You haven't posted anything yet
           <a href="{{ route('post.new-article') }}"> add </a> new post.
        </span>
      </div>
      @else

      <h1 class="text-xs-center"> My posts </h1>
      <p> A list of articles submitted by you, check <a href=""> all posts </a> submitted by
        other users. We only count views on your post from logged in users means no views will be
        counted from visitors outside the website.
      </p>

      @foreach ($posts as $post)
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="card card-block">
            <h3 class="card-title">{{ $post->title }}</h3>
            <p class="card-text"><b> Published: </b> {{ $post->created_at->diffForHumans() }} </p>
            <a href="{{ route('post.single-post', ['slug' => $post->slug]) }}" class="btn btn-primary">Read post</a>
          </div>
        </div>
      @endforeach

      @endif

    </div>
  </div>

@stop
