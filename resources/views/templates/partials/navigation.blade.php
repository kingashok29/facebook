<nav class="navbar navbar-full navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Earnm</a>

    <ul class="nav navbar-nav">

       @if (Auth::check())

    <li class="nav-item"><a class="nav-link" href=" {{ route('home') }} "> <i class="fa fa-newspaper-o"></i> Timeline</a></li>
    <li class="nav-item"><a class="nav-link"  href=" {{ route('friends.index') }} "> <i class="fa fa-users"></i>  Friends</a></li>
    <li class="nav-item"><a class="nav-link"  href=" {{ route('post.new-article') }} "> <i class="fa fa-plus-circle"></i>  New article </a></li>
    <li class="nav-item"><a class="nav-link"  href=" {{ route('categories.index') }} "> <i class="fa fa-list"></i>  Categories </a></li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-file-text-o" aria-hidden="true"></i> Posts
      </a>
        <div class="dropdown-menu" aria-labelledby="Preview">
          <a class="dropdown-item" href="{{ route('posts.all-posts') }} "> <i class="fa fa-home"></i> All Posts </a>
          <a class="dropdown-item" href="{{ route('posts.index') }} "> <i class="fa fa-file"></i> My Posts </a>
          <a class="dropdown-item" href="{{ route('posts.all-drafts') }}"> <i class="fa fa-folder-open"></i> Drafts </a>
          <a class="dropdown-item" href="{{ route('posts.pending-posts') }}"> <i class="fa fa-exclamation-circle"></i> Pending posts </a>
        </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-file-text-o" aria-hidden="true"></i> Contest
      </a>
        <div class="dropdown-menu" aria-labelledby="Preview">
          <a class="dropdown-item" href=""> <i class="fa fa-quiz"></i> All Contests </a>
      </div>
    </li>


    <li class="nav-item dropdown pull-lg-right">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
        <img src="{{ URL::asset('images/profile-images') }}/{{ Auth::user()->profile_pic }}" alt="{{ Auth::user()->username }}"
          style="width:25px; height:25px; border-radius:50%; margin:auto 7px;">
        {{ Auth::User()->getNameOrUsername() }}
      </a>
        <div class="dropdown-menu" aria-labelledby="Preview">
          <a class="dropdown-item" href="{{ route('profile.index',['username' => Auth::user()->username ]) }} "> <i class="fa fa-user fa-wd"></i> Profile</a>
          <a class="dropdown-item" href="{{ route('bank.index', ['username' => Auth::user()->username ]) }}"> <i class="fa fa-money fa-wd"></i> My Bank </a>
          <a class="dropdown-item" href="{{ route('edit.basic') }} "> <i class="fa fa-pencil fa-wd"></i> Update profile</a>
          <a class="dropdown-item" href="{{ route('auth.signout') }} "> <i class="fa fa-sign-out fa-wd"></i> Signout</a>
        </div>
    </li>

    <li class="nav-item pull-lg-right">
      <form class="form-inline" action="{{ route('search.results') }}">
        <input class="form-control" type="text" name="query" placeholder="Search">
        <button class="btn btn-outline btn-default" type="submit">Search</button>
      </form>
    </li>

      @else

    <div class="pull-right">
      <li class="nav-item"><a class="nav-link"  href=" {{ route('auth.signup') }} "> <i class="fa fa-user-plus"></i> Sign up</a></li>
      <li class="nav-item"><a class="nav-link"  href=" {{ route('auth.signin') }} "> <i class="fa fa-sign-in"></i> Sign in</a></li>
   </div>

      @endif

   </ul>
</nav>
