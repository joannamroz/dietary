
<div class="sidebar">
  <div class="quickmenu">
    <div class="quickmenu__cont">
      <div class="quickmenu__list">
        <div class="quickmenu__item active">
          <div class="fa fa-fw fa-home"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="scrollable scrollbar-macosx">
    <div class="sidebar__cont">
      <div class="sidebar__menu">
        <div class="sidebar__title">Pages</div>
        <ul class="nav nav-menu">
          <li><a href="{{ url('./') }}">
              <div class="nav-menu__ico"><i class="fa fa-fw fa-star"></i></div>
              <div class="nav-menu__text"><span>Dashboard</span></div></a>
          </li>
          <li><a href="{{ url('/food/index') }}">
              <div class="nav-menu__ico"><i class="fa fa-shopping-basket"></i></div>
              <div class="nav-menu__text"><span>Foods</span></div></a>
          </li>
          <li><a href="{{ url('/brand/index') }}">
              <div class="nav-menu__ico"><i class="fa fa-registered"></i></div>
              <div class="nav-menu__text"><span>Brands</span></div></a>
          </li>
          <li><a href="{{ url('/meal/index') }}">
              <div class="nav-menu__ico"><i class="fa fa-cutlery"></i></div>
              <div class="nav-menu__text"><span>Meals</span></div></a>
          </li>
          <li><a href="{{ url('/exercise/index') }}">
              <div class="nav-menu__ico"><i class="fa fa-bicycle"></i></div>
              <div class="nav-menu__text"><span>Activity</span></div></a>
          </li>
          <li><a href="{{ url('/training') }}">
              <div class="nav-menu__ico"><i class="fa fa-heart"></i></div>
              <div class="nav-menu__text"><span>Training</span></div></a>
          </li>
          <li><a href="{{ url('/user/index') }}">
              <div class="nav-menu__ico"><i class="fa fa-users"></i></div>
              <div class="nav-menu__text"><span>Users</span></div></a>
          </li>
        </ul>
      </div> <!-- sidebar menu -->
    </div> <!-- sidebar count -->
  </div>
</div>