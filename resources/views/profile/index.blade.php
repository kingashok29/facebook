@extends('templates.default')

@section('content')

  <div class="row">
    <div class="col-lg-4 offset-lg-1 col-md-8 offset-md-2 col-sm-12">
      <!-- User info and status -->
        @include ('user.partials.profile-block')
        <hr>

        <example></example>

          <!-- Here we can show the all statuses submitted by specific user with option to reply
          but this reply will bw only available to friends of that specific user. -->

          @if(!$statuses->count())
            <p class="text-center text-primary"> <b> {{ $user->getNameOrUsername() }} </b> has not posted anything yet :( </p>
          @else
            @foreach ($statuses as $status)

          <ul class="media-list">
            <li class="media">
             <div class="media-left">
               <a href=" {{ route('profile.index', ['$username' => $status->user->username ]) }} ">
                 <img class="media-object" style="border-radius:50%; border:3px solid #1C4648; width:85px; height:85px; padding:3px;"
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
                     <img class="media-object" style="border-radius:50%; border:3px solid #1C4648; padding:3px; width:75px; height:75px;"
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

              @if($authUserIsFriend || Auth::user()->id === $status->user->id)
              <br>
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
                @endif

            @endforeach

            {!! $statuses->render() !!}

          @endif

    </div>
    <div class="col-lg-5 col-md-8 offset-md-2 col-sm-12">
      <!-- list of friends & friend requests -->

      <!-- If visitor already send request to this user then show waiting message -->
      @if (Auth::user()->hasFriendRequestPending($user))
        <p class="text-primary"> Waiting for <b> {{ $user->getNameOrUsername() }} </b> to accept
          your friend request. </p>
      @elseif (Auth::user()->hasFriendRequestReceived($user))
        <a href=" {{ route('friend.accept', ['username' => $user->username]) }} " class="btn btn-primary"> Accept friend request </a>
      @elseif (Auth::user()->isFriendWith($user))
        <p class="text-success"> You and {{ $user->getFirstNameOrUsername() }} are now friend. </p>

        <form action="{{ route('friend.delete', ['username' => $user->username]) }}" method="post">
          <input type="submit" class="btn btn-warning btn-sm btn-block" value="unfriend this user">
          {{ csrf_field() }}
        </form>

      @elseif (Auth::user()->id !== $user->id)
        <a href=" {{ route('friend.add', ['username' => $user->username]) }} " class="btn btn-primary"> Add as friend </a>
      @endif

      <h4> {{ $user->getNameOrUsername() }}'s friends. </h4>

      @if (!$user->friends()->count())
       <p class="text-danger"><b> Sorry, but {{ $user->getFirstNameOrUsername() }} has no friends yet. </b></p>
      @else
        @foreach ($user->friends() as $user)
          @include('user/partials/userblock')
        @endforeach
      @endif

    </div>
  </div>

@stop
