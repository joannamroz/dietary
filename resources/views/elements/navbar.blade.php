
<nav class="navbar navbar-static-top header-navbar" style='position:absolute'>
  <div class="header-navbar-mobile">
    <div class="header-navbar-mobile__menu">
      <button type="button" class="btn"><i class="fa fa-bars"></i></button>
    </div>
    <div class="header-navbar-mobile__title"><span>Dashboard</span></div>
    <div class="header-navbar-mobile__settings dropdown"><a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="btn dropdown-toggle"><i class="fa fa-bars"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{url('/user/profile/'.Auth::id())}}">Profile</a></li>
        <li><a href="{{ url('/auth/logout') }}">Log Out</a></li>
      </ul>
    </div>
  </div>
  <div class="navbar-header"><a href="/" class="navbar-brand">
    <div class="logo text-nowrap">
      <div class="logo__img"><i class="fa fa-chevron-right"></i></div><span class="logo__text">Dietary</span>
    </div></a>
  </div>
  <div class="topnavbar">
    <ul class="nav navbar-nav navbar-left">
      <li class="active"><a href="{{ url('/') }}"><span>Dashboard</span></a></li>
      <li class="active"><a href="{{ url('/') }}"><span>Log meal++</span></a></li>
    </ul>
    <ul class="userbar nav navbar-nav">
      <li> <a href="{{url('/user/profile/'.Auth::id())}}">My Profile</a> </li>
      <li class="dropdown"><a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="userbar__settings dropdown-toggle"><i class="fa fa-bars"></i></a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="{{url('/user/profile/'.Auth::id())}}">Profile</a></li>
          <li><a href="{{ url('/auth/logout') }}">Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
