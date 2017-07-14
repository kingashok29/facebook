@extends('templates.default')
@section('content')

  <h1 class="text-xs-center"> Submit new article </h1>
  <p class="text-xs-center"> Hey <b> {{ Auth::user()->getNameOrUsername() }} </b>, Please read our <a href=""> article guideline </a>
    before submitting article. It will help you a lot to understand rules, thanks! </p>

  <div class="row">
    <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">

    <form action="{{ route('post.new-article') }}" method="post" enctype="multipart/form-data">

      <div class="form-group col-lg-6 {{ $errors->has('title') ? 'has-danger' : '' }}">
        <label for="title" class="col-form-label"> Post title </label>
        <input type="text" class="form-control form-control-danger" name="title" placeholder="Enter title of Article" value="{{ Request::old('title') ?: '' }}">

        @if ($errors->has('title'))
          <div class="form-control-feedback"> {{ $errors->first('title') }} </div>
        @endif
      </div>

      <div class="form-group col-lg-6 {{ $errors->has('category') ? 'has-danger' : '' }}">
        <label for="category" class="col-form-label form-control-danger"> Post category </label>
        <select class="form-control" name="category" value="{{ Request::old('category') }}">
          <option value="0"> -- Select category for article -- </option>
          @foreach ($categories as $category)
            <option value="{{$category->category_id}}">{{ $category->category_name }}</option>
          @endforeach
        </select>

        @if ($errors->has('category'))
          <div class="form-control-feedback"> {{ $errors->first('category') }} </div>
        @endif
      </div>

      <div class="form-group col-lg-6 {{ $errors->has('image') ? 'has-danger' : '' }}">
        <label for="image" class="col-form-label"> Post cover image </label>
        <input type="file" class="form-control form-control-danger" name="image" value="{{ Request::old('image') ?: '' }}">

        @if ($errors->has('image'))
          <div class="form-control-feedback"> {{ $errors->first('image') }} </div>
        @endif
      </div>

      <div class="form-group col-lg-6 {{ $errors->has('image_credit') ? 'has-danger' : '' }}">
        <label for="image_credit" class="col-form-label"> Image credit </label>
        <input type="text" class="form-control form-control-danger" name="image_credit" value="{{ Request::old('image_credit') ?: '' }}" placeholder="Specify proper credit of your image.">

        @if ($errors->has('image_credit'))
          <div class="form-control-feedback"> {{ $errors->first('image_credit') }} </div>
        @endif
      </div>

      <div class="form-group col-lg-12 {{ $errors->has('summery') ? 'has-danger' : '' }}">
        <label for="summery" class="col-form-label"> Post summery </label>
        <input type="text" class="form-control form-control-danger" name="summery" placeholder="Enter short summery of Article" value="{{ Request::old('summery') ?: '' }}">

        @if ($errors->has('summery'))
          <div class="form-control-feedback"> {{ $errors->first('summery') }} </div>
        @endif
      </div>

      <div class="form-group col-lg-12 {{ $errors->has('body') ? 'has-danger' : '' }}">
        <label for="body" class="col-form-label"> Post content </label>
        <textarea class="form-control form-control-danger" name="body" rows="6" placeholder="This is the main part of post, add more then 400 charecters here.">{{ Request::old('body') }}</textarea>

        @if ($errors->has('body'))
          <div class="form-control-feedback"> {{ $errors->first('body') }} </div>
        @endif
      </div>

      <div class="form-group col-lg-12">
        <input type="submit" class="btn btn-md btn-success" value="Submit article">
        <a href="" role="button" class="btn btn-md btn-secondary btn-outline">Save as draft</a>
      </div>
      {{ csrf_field() }}
    </form>
<!--  -->

  </div>
</div>


@stop
