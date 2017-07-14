  <div class="card card-block">
    <h4 class="card-title">{{ $user->username }}</h4>
    <p class="card-text">
      @if(!$user->about === "")
        <b>About:</b> {{ $user->about }}
      @else
        <b>About:</b> No info available.
      @endif
    </p>
    <a href="{{ route('profile.index', ['username' => $user->username ]) }}" class="card-link btn btn-sm btn-info btn-outline">Visit profile</a>
  </div>
