    <nav class="navbar navbar-expand fixed-top">
      <div class="navbar-brand d-none d-lg-block">
        <a href="dashboard" style="color: #fff;">
          ATTENTION
        </a>
      </div>
      <div class="container-fluid p-0">
        <button id="tour-fullwidth" type="button" class="btn btn-default btn-toggle-fullwidth"><i class="ti-menu"></i></button>
        <form class="form-inline search-form mr-auto d-none d-sm-block">
          <div class="input-group">
            <input type="text" value="" class="form-control" placeholder="Search dashboard...">
            <div class="input-group-append">
              <button type="button" class="btn"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
        <div id="navbar-menu">
          <ul class="nav navbar-nav align-items-center">

            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('user.png') }}" class="user-picture" alt="Avatar"> <span>{{ Auth::user()->username }}</span></a>
              <ul class="dropdown-menu dropdown-menu-right logged-user-menu">
                <li><a href="{{ route('profile') }}"><i class="ti-user"></i> <span>My Profile</span></a></li>
                {{-- <li><a href="appviews-inbox.html"><i class="ti-email"></i> <span>Message</span></a></li> --}}
                <li><a href="{{ route('settings') }}"><i class="ti-settings"></i> <span>Settings</span></a></li>
                <li><a href="{{ route('logout') }}"><i class="ti-power-off"></i> <span>Logout</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>