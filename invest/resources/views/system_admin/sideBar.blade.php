<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<div id="sidebar-nav" class="sidebar">
      <nav>
        <ul class="nav" id="sidebar-nav-menu">
          <li class="menu-group">Main: {{ Auth::user()->country }}</li>
          <li class="panel">
            <a href="{{ route('admin-dashboard') }}" dagta-toggle="collapse" data-parepnt="#sidebar-nav-menu" aria-expanded="true" class="active"><i class="ti-dashboard"></i> <span class="title">Dashboard</span> <i clask="icon-submenu ti-angle-left"></i></a>

          </li>
          <li><a href="#" class=""><i class="ti-user"></i> <span class="title">My Account</span></a></li>
          <li><a href="{{ route('users') }}" class=""><i class="fa fa-users"></i> <span class="title">All Users</span></a></li>
          <li><a href="{{ route('B2C') }}" class=""><i class="fa fa-money"></i> <span class="title">B2C Payments</span></a></li>
          <li><a href="{{ route('C2B') }}" class=""><i class="fas fa-money-bill-alt"></i> <span class="title">C2B Payments</span></a></li>
          <li><a href="{{ route('payment-methods') }}" class=""><i class="fa fa-list"></i> <span class="title">Payment Methods</span></a></li>
          <li><a href="{{ route('upload-video') }}" class=""><i class="fab fa-youtube"></i> <span class="title">Youtube Videos</span></a></li>
          <li><a href="{{ route('manage-blogs') }}" class=""><i class="fab fa-blogger"></i> <span class="title">Blogs</span></a></li>
          <li><a href="{{ route('manage-surveys') }}" class=""><i class="fas fa-poll-h"></i> <span class="title">Surveys</span></a></li>
          <li><a href="{{ route('settings') }}" class=""><i class="fa fa-cogs"></i> <span class="title">Site Settings</span></a></li>
          
        </ul>
        <button type="button" class="btn-toggle-minified" title="Toggle Minified Menu"><i class="ti-arrows-horizontal"></i></button>
      </nav>
    </div>