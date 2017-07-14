@extends('templates.default')
@section('content')

  <div class="row">
    <div class="col-lg-10 lg-offset-1 col-md-10 offset-md-1 col-sm-12">

      @if ($count === 0)
      <div class="text-xs-center" style="color:#8C999A; margin:10% auto;">
        <h3> No posts </h3>
        <span> Nothing posted yet!
           <a href="{{ route('post.new-article') }}"> add </a> new post.
        </span>
      </div>

      @else

        <h1 class="text-xs-center"> All posts </h1>
        <p>
          Here is a list of all recent posts submitted by users on site, Posts are sorted on the time means
          latest submitted posts will appear first and then other, we are also working on some new algorithum
          and that will be available soon.
        </p>

        </div>
      </div>
      <div class="row">

      @foreach ($posts as $post)

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card-deck-wrapper">
            <div class="card-deck">
              <div class="card text-xs-center">
                <div class="card-header">
                  {{ $post->post_type }} Post
                </div>
                <div class="card-block">
                  <h4 class="card-title">{{ $post->title }}</h4>
                  <p class="card-text">{{ $post->summery }}</p>
                  <a href="{{ route('post.single-post',['slug' => $post->slug]) }}" class="btn btn-outline-primary">Read post</a>
                  <a href="" class="btn btn-outline-info">Views: 34</a>
                </div>
                <div class="card-footer text-muted">
                   <b> Published: </b> {{ $post->created_at->diffForHumans() }}
                </div>
              </div>
            </div>
          </div>
        </div>

      @endforeach
    </div>

      @endif

    </div>
  </div>

@stop
