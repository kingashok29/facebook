@extends('templates.default')
@section('content')

    @if ($count === 0)
    <div class="text-xs-center" style="color:#8C999A; margin:10% auto;">
      <h3> No Drafts </h3>
      <span> No drafts in your account. </span>
    </div>
    @else

    <div class="row">
      <div class="col-lg-6 lg-offset-3 col-md-10 offset-md-1 col-sm-12">

        <h1 class="text-xs-center"> Your drafts <span class="tag tag-pill tag-primary">{{ $count }}</span></h1>
        <p>
          List of all posts you saved them as draft. You can Publish them, Publish them after edit or even You
          can delete them. So go ahead and take any of action for these drafts.
        </p>

      </div>
      <div class="col-lg-6 lg-offset-3 col-md-10 offset-md-1 col-sm-12">

    @foreach ($drafts as $draft)

        <div class="card card-block">
          <h3 class="card-title">{{ $draft->title }}</h3>
          <p class="card-text"><b> Saved: </b> {{ $draft->created_at->diffForHumans() }} </p>
          <a href="" class="btn btn-success">Publish</a>
          <a href="" class="btn btn-primary">Edit &amp; Publish</a>
          <a href="" class="btn btn-danger">Delete</a>
        </div>

    @endforeach
    </div>

    @endif

    </div>
  </div>

@stop
