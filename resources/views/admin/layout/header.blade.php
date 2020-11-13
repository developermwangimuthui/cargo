<header class="topbar-nav">
  <nav class="navbar navbar-expand">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>

    </ul>

    <ul class="navbar-nav align-items-center right-nav-link">
      <li class="nav-item">

        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
          <span class="user-profile">

              {{-- <img src="{{ Auth::user()->profile_photo == "" ? '/frontend/images/pf.png': url('/ProfilePics').'/'.Auth::user()->profile_photo}}"
              alt="img" class="img-circle" --}}
              ></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item user-details">
            <a href="javaScript:void();">

              <div class="media">
                <div class="avatar">
                    {{-- <img class="align-self-start mr-3" src="{{ Auth::user()->profile_photo == "" ? '/frontend/images/pf.png': url('/ProfilePics').'/'.Auth::user()->profile_photo}}"
                    alt="img"> --}}
                <div class="media-body">

                  <h6 class="mt-2 user-title"></h6>
                  <p class="user-subtitle"></p>

                </div>
              </div>
            </a>
          </li>
          <li class="dropdown-divider"></li>
          <li class="dropdown-item"><i class="icon-power mr-2"></i>
            <a ref="" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <form id="logout-form" action="" method="POST" style="display: none;">
    @csrf
  </form>
</header>
