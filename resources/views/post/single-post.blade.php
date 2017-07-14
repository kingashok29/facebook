@extends('templates.default')
@section('content')

  <div class="row">
    <div class="col-lg-6 offset-lg-1 col-md-12 col-sm-12">

        <h1> Title: {{ $post->title }} </h1>
        <h3> Summery: {{ $post->summery }} </h3>
        <p> Post body: {{ $post->body }} </p>
        <br><hr>
        <ul class="inline-item">
          <li class="list-item">  Category: <b> {{ $category->category_name }} </b></li>
          <li class="list-item">   Submitted by: <b> {{ $username->username }} </b></li>
          <li class="list-item">   Submission Time : <b> {{  $post->created_at->diffForHumans() }} </b></li>
        </ul>

        <hr>

      @if(!Auth::check())
        <h3> Please Login or Signup to reply this post. </h3>
      @else
        <h3> Fill the form below to reply this post. </h3>
      @endif

      <form class="" action="{{ route('article.comment', ['postId' => $post->id ]) }}" method="post">
        @if($errors)
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        @endif
        <div class="form-group row">
          <textarea rows="3" cols="80" class="form-control" placeholder="Hey {{ Auth::user()->getNameOrUsername() }}, write your reply and submit." name="article-comment"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" name="reply" class="btn btn-primary btn-md"> Submit my reply </button>
        </div>
        {{ csrf_field() }}
      </form>

    </div>
  </div>

<style>
h1, h3 {
    font-family: 'Amatic SC', cursive;
}
p, li {
    font-family: 'Josefin Sans', sans-serif;
    }
</style>
@stop
