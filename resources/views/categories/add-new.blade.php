@extends('templates.default')
@section('content')

  <div class="row">
    <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">

      <h1 class="text-xs-center"> Add new category </h1>
      <p> If you did not found category you were looking for then fill the form below and submit, we will
      review your request and after that we will update category on website. </p>


      <form action="{{ route('categories.add-new')}}" method="post" enctype="multipart/form-data">
        <div class="form-group col-lg-8 {{ $errors->has('category_name') ? 'has-danger' : ''}}">
          <label for="category_name" class="col-form-label"> Category Name: </label>
          <input type="text" name="category_name" class="form-control form-control-danger" placeholder="Title of category" value="{{ Request::old('category_name') }}">
          @if ($errors->has('category_name'))
            <div class="form-control-feedback">{{ $errors->first('category_name') }}</div>
          @endif
        </div>

        <div class="form-group col-lg-8 {{ $errors->has('category_image') ? 'has-danger' : ''}}">
          <label for="category_image" class="col-form-label"> Category Image </label>
          <input type="file" name="category_image" class="form-control form-control-danger" value="{{ Request::old('category_image') }}">
          @if ($errors->has('category_image'))
            <div class="form-control-feedback">{{ $errors->first('category_image') }}</div>
          @endif
        </div><br>

        <div class="form-group col-lg-8 {{ $errors->has('category_details') ? 'has-danger' : ''}}">
          <label for="category_details" class="col-form-label"> Category Details </label>
          <textarea class="form-control form-control-danger" name="category_details" placeholder="Details of category">{{ Request::old('category_details') }}</textarea>
          @if ($errors->has('category_details'))
            <div class="form-control-feedback">{{ $errors->first('category_details') }}</div>
          @endif
        </div>

        <div class="form-group col-lg-8">
          <input type="submit" class="btn btn-md btn-primary" value="Submit category request">
          <a href="{{ route('categories.index') }}" class="btn btn-md btn-outline-secondary"> Cancel </a>
        </div>
        {{ csrf_field() }}
      </form>

  </div>
</div>

@stop
