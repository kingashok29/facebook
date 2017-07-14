@extends('templates.default')
@section('content')

    @if ($count === 0)
    <div class="text-xs-center" style="color:#8C999A; margin:10% auto;">
      <h3> No Pending Posts </h3>
      <span> Great! Nothing here. <a href="{{ route('post.new-article') }}"> add </a> new post </span>
    </div>
    @else

    <div class="row">
      <div class="col-lg-6 lg-offset-3 col-md-10 offset-md-1 col-sm-12">

        <h1 class="text-xs-center"> Pending Posts <span class="tag tag-pill tag-primary">{{ $count }}</span></h1>
        <p>
          List of all pending posts. You can see the live status of your post along with all details.
        </p>

      </div>
      <div class="col-lg-6 lg-offset-3 col-md-10 offset-md-1 col-sm-12">

    @foreach ($pending_posts as $draft)

        <div class="card card-block">
          <h3 class="card-title">{{ $draft->title }}</h3>
          <p class="card-text"><b> Saved: </b> {{ $draft->created_at->diffForHumans() }} </p>
          <p> Status:
            @if ($draft->status_msg === 'Pending')
              <b><span class="text-warning"> Pending </span><br></b>
              Reason: <b> {{ $draft->status_reason }} </b>
            @elseif ($draft->status_msg === 'Rejected')
              <b> <span class="text-danger"> Rejected </span><br></b>
               Reason: <b> {{ $draft->status_reason }} </b>
            @else
              <span class="text-primary"> No action yet </span>
            @endif
          </p>
        </div>

    @endforeach
    </div>

    @endif

    </div>
  </div>

@stop
