<div class="card card-inverse card-outline-primary text-xs-center">
  <div class="card-block">
    <div class="pull-left">
      <a href=" {{ route('profile.index', ['username' => $user->username ]) }} ">
        <img class="media-object"
        style="border-radius:50%; border:3px solid #928A97; padding:3px; width:80px; hwight:80px;"
        src=" {{ URL::asset('images/profile-images') }}/{{ $user->profile_pic }} "
        alt=" {{ $user->getNameOrUsername() }} ">
      </a>
    </div>
      <h4 class="media-heading"><a href=" {{ route('profile.index', ['username' => $user->username ]) }} "> {{ $user->getNameOrUsername() }} </a></h4>
      @if ($user->location)
        <p> {{ $user->location }} </p>
      @endif
  </div>
</div>
