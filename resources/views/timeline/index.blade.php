@extends('templates.default')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 text-xs-center">
  <h1> Your timeline </h1>
  <p> Here you can view status of other users as well you can Update your status too. </p>
</div><hr><br><br>

<div class="row">
  <div class="col-lg-4 offset-lg-1 col-md-12 col-sm-12">


    <form role="form" action="{{ route('status.post') }}" method="post">
      <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
        <textarea class="form-control" placeholder="What's up {{ Auth::user()->getFirstNameOrUsername() }}?"
          rows="4" name="status"></textarea>
        @if ($errors->has('status'))
          <span class="help-block"> {{ $errors->first('status') }} </span>
        @endif
      </div>
      <button type="submit" class="btn text-center btn-success btn-block"> Post status </button>
      {{ csrf_field() }}
    </form>


  </div>
  <div class="col-lg-6 col-md-12 col-sm-12">
    <!-- here is statuses -->

      @if(!$statuses->count())
        <p class="text-center text-secondary"> Sorry but there is no status to show in timeline :( </p>
      @else
        @foreach ($statuses as $status)
        
      <ul class="media-list">
        <li class="media">
         <div class="media-left">
           <a href=" {{ route('profile.index', ['$username' => $status->user->username ]) }} ">
             <img class="media-object" style="border-radius:50%; width:85px; height:85px; border:3px solid #295E62; padding:3px;"
             src="{{ URL::asset('images/profile-images') }}/{{ $status->user->profile_pic }}"
             alt="{{ $status->user->getFirstNameOrUsername() }}">
           </a>
         </div>
        <div class="media-body">
          <h4 class="media-heading">
            <a href=" {{ route('profile.index', ['$username' => $status->user->username ]) }} ">
             {{ $status->user->getNameOrUsername() }}
           </a>
         </h4>

          <p> {{ $status->body }} </p>
            <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-clock-o"></i> {{ $status->created_at->diffForhumans() }} </li>
                <li class="list-inline-item"><i class="fa fa-thumbs-up"></i> {{ $status->likes()->count() }} {{ str_plural('like', $status->likes->count()) }}</li>
                @if ($status->user->id !== Auth::user()->id )
                  <li class="list-inline-item"><a href="{{ route('status.like', ['statusId' => $status->id ]) }}">
                    @if (!Auth::user()->hasLikedStatus($status))
                      Like this
                    @else
                      You liked this
                    @endif
                  </a></li>
                @endif

            </ul><br>

        @foreach ($status->replies as $reply)

            <div class="media reply">
             <div class="media-left">
               <a href=" {{ route('profile.index', ['username' => $reply->user->username ]) }} ">
                 <img class="media-object" style="border-radius:50%; width:75px; height:75px; border:3px solid #295E62; padding:3px;"
                 src=" {{ URL::asset('images/profile-images') }}/{{ $reply->user->profile_pic }} "
                 alt=" {{ $reply->user->username }} ">
               </a>
             </div>
            <div class="media-body">
              <h4 class="media-heading"><a href="{{ $reply->user->username }}">
                {{ $reply->user->getNameOrUsername() }}
               </a></h4>
                <p> {{ $reply->body }} </p>
                <ul class="list-inline">

                    <li class="list-inline-item"><i class="fa fa-clock-o"></i> {{ $reply->created_at->diffForhumans() }} </li>
                    <li class="list-inline-item"><i class="fa fa-thumbs-up"></i> {{ $reply->likes()->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
                    @if ($status->user->id !== Auth::user()->id )
                      <li class="list-inline-item"><a href="{{ route('status.like', ['statusId' => $reply->id ]) }}">
                        @if(!Auth::user()->hasLikedStatus($reply))
                          Like this
                        @else
                          You liked this
                        @endif
                      </a></li>
                    @endif

                </ul>
              </div>

            @endforeach
          </div>
        </li>
      </ul>


            <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
              <div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
                <textarea class="form-control" placeholder="Hey {{ Auth::user()->getFirstNameOrUsername()
                }} write your reply!"
                  rows="2" name="reply-{{ $status->id }}"></textarea>
                @if ($errors->has("reply-{$status->id}"))
                  <span class="help-block"> {{ $errors->first("reply-{$status->id}") }} </span>
                @endif
              </div>
              <input type="hidden" name="user_id" value=" {{ Auth::user()->id }} ">
              <button type="submit" class="btn text-center btn-default"> Submit reply </button>
              {{ csrf_field() }}
            </form>
            <br>

        @endforeach

        {!! $statuses->render() !!}

      @endif

  </div>
</div>

@stop
