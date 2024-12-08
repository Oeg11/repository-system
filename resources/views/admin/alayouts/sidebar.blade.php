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
            <i class="fa fa-user"></i> Hello!, {{ Auth::user()->email }}
          </a>
        </li>


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-power-off"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="{{  route('admin.changepassword')}}" class="dropdown-item mt-2">
              <i class="fa fa-lock"></i> Change Password
            </a>
            <form method="POST" action="{{ route('student.logout') }}">
              @csrf

              <a class="dropdown-item p-3 text-dark"  href="route('student.logout')"
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
      <a href="{{route('admin.dashboard')}}" class="brand-link">

        <!--<img src="{{ asset('assets/img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
        <span class="brand-text font-weight-light">STI Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2" id="myDIV">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{route('admin.dashboard')}}"  class="nav-link btns">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>



            <li class="nav-item">
              <a href="{{route('admin.archive')}}" class="nav-link btns">
                  <i class="nav-icon fa fa-box"></i>
                <p>
                  Collection List
                </p>
              </a>
            </li>



            <li class="nav-item">
              <a href="{{route('admin.studentlist')}}" class="nav-link btns">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Student List
                </p>
              </a>
            </li>


            <li class="nav-header">Maintenance</li>


            <li class="nav-item">
              <a href="{{route('admin.departmentlist')}}" class="nav-link btns">
                <i class="nav-icon fa fa-list"></i>
                <p>
                  Department List
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.curriculumlist')}}" class="btns nav-link">
                <i class="nav-icon fa fa-scroll"></i>
                <p>
                   Curriculum List
                </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.faculty_stafflist')}}" class="nav-link btns">
                    <i class="nav-icon fa fa-users-cog"></i>
                  <p>
                     Faculty/Staff List
                  </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.usercontrol')}}" class="nav-link btns">
                    <i class="nav-icon fa fa-desktop"></i>
                  <p>
                     User Control
                  </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.settings')}}" class="nav-link btns">
                    <i class="nav-icon fa fa-cogs"></i>
                  <p>
                     Settings
                  </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{route('admin.reports')}}" class="nav-link btns">
                    <i class="nav-icon fa fa-print"></i>
                  <p>
                     Reports
                  </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.backupdb')}}" class="nav-link btns">
                    <i class="nav-icon fa fa-print"></i>
                  <p>
                     Backup Database
                  </p>
                </a>
            </li>

            {{-- my added module --}}
            <li class="nav-item">
                <a href="{{route('admin.userimport')}}" class="nav-link btns">
                    <i class="nav-icon fa fa-upload"></i>
                  <p>
                     Batch Upload
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
        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("btns");
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";
          });
        }
        </script>
