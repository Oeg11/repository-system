<div class="wrapper">

    <!-- Preloader -->
    <!--<div class="preloader flex-column justify-content-center align-items-center">-->
    <!--  <img class="animation__shake" src="{{asset('assets/img/logo.jpg')}}" alt="AdminLTELogo" height="60" width="60" style="border-radius: 50%">-->
    <!--</div>-->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> --}}

        <!-- Messages Dropdown Menu -->


        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">

            @if (auth()->check())
            <i class="fa fa-user"></i> Hello!, {{ $user->email }}
          @else
              <p>You are not logged in.</p>
          @endif

          </a>
        </li>


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-power-off"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            {{-- <a href="#" class="dropdown-item">
              <i class="fa fa-arrow-right"></i> logout
            </a> --}}

            <form method="POST" action="{{ route('studentgoogleauth.logout') }}">
              @csrf

              <a class="dropdown-item p-3 text-dark"  href="route('studentgoogleauth.logout')"
                      onclick="event.preventDefault();
                                 this.closest('form').submit();">
                  <i class="fa fa-arrow-right"></i>  {{ __('Log Out') }}
              </a>
          </form>

        </li>


      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <a href="{{route('dashboard.google')}}" class="brand-link">
        <img src="{{asset('assets/img/131507_hacker_administrator_system_sys_hack_icon.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Student Panel</span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2" id="myDIV_">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{route('dashboard.google')}}" class="nav-link btns_">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>



            <li class="nav-item">
              <a href="{{route('studentgoogleauth.thesiscapstone')}}" class="nav-link btns_">
                  <i class="nav-icon fa fa-upload"></i>
                <p>
                  Submit Thesis/Capstone
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('studentgoogleauth.project')}}" class="nav-link btns_">
                <i class="nav-icon fa fa-file"></i>
                <p>
                  Projects
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('googleauthstudents.profile')}}" class="nav-link btns_">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  Profile
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('googleauthstudents.status')}}" class="nav-link btns_">
                <i class="nav-icon fa fa-layer-group"></i>
                <p>
                  My Project status
                </p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("myDIV_");
        var btns = header.getElementsByClassName("btns_");
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";
          });
        }
 </script>
