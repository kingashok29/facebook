@extends('templates.default')
@section('content')

  <div class="row">
    <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <h1 class="text-xs-center"> Categories </h1>
      <p> A list of all categories with related information, as well you can see the number of posts which are
        submitted in specific category. You can still
        <a href="{{ route('categories.add-new') }}"> Add New </a> category. </p>
    </div>

  <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">

@foreach($categories as $category)
    <div class="col-lg-4 col-md-10 col-sm-12">
      <div class="card">
          <div class="card-block">
          <h4 class="card-title"> {{ $category->category_name }} </h4>
          <p class="card-text"> {{ $category->category_details }} </p>
          <a href="#" class="btn btn-primary"><b> Posts: </b>{{ $category->total_posts }}</a>
          </div>
      </div>
    </div>
@endforeach

  </div>
</div>

@stop
