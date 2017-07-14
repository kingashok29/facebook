<div class="well well-lg" style="height:200px;">
 <div class="pull-left">
  <a href=" {{ route('profile.index', ['username' => $user->username ]) }} ">
    <img class="media-object"
      style="border-radius:50%; border:3px solid #928A97; width:120px; height:120px; padding:3px;"
      src=" {{ URL::asset('images/profile-images') }}/{{ $user->profile_pic }} "
      alt=" {{ $user->getNameOrUsername() }} ">
  </a>
</div>

<div class="pull-right">
    <h4 class="media-heading"><a href=" {{ route('profile.index', ['username' => $user->username ]) }} "> {{ $user->getNameOrUsername() }} </a></h4>
    @if ($user->location)
      <p> {{ $user->location }} </p>
    @endif
    <p>
      Username: <code>{{ $user->username }}</code> <br>
      Email: <code> {{ $user->email }} </code>
    </p>
</div>

</div>
