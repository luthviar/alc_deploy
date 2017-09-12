  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a  class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="text-left">
         <span class="logo-lg"><b>ALC Admin Page</span>
      </span>

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->get_nama()}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                @if(Auth::user()->get_photo() == null)
                <img src="{{URL::asset('photo.jpg')}}" class="img-circle" alt="User Image">
                @else
                <img src="{{URL::asset(Auth::user()->get_photo())}}" class="img-circle" alt="User Image">
                @endif

                <p>
                  {{Auth::user()->get_structure()}}
                  <small>Member since {{Auth::user()->get_join()}}</small>
                </p>
              </li>        
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">

                  <a href="/" class="btn btn-success btn-flat">Act as user</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>