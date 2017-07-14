<div class="media">
  <a class="pull-left" href=" {{ route('profile.index', ['username' => $user->username ]) }} ">
    <img class="media-object"
    style="border-radius:50%; border:3px solid #928A97; padding:3px; width:60px; hwight:60px;"
    src=" {{ URL::asset('images/profile-images') }}/{{ $user->profile_pic }} "
    alt=" {{ $user->getNameOrUsername() }} ">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><a href=" {{ route('profile.index', ['username' => $user->username ]) }} "> {{ $user->getNameOrUsername() }} </a></h4>
    @if ($user->location)
      <p> {{ $user->location }} </p>
    @endif
  </div>
</div>
