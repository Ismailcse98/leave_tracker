<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}}" class="brand-link">
      <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin')}}" class="nav-link @yield('dashboard')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>

          <li class="nav-item @yield('employee')">
            <a href="#" class="nav-link @yield('employee-list')">
              <i class="fas fa-regular fa-users nav-icon"></i>
              <p>
                Employee
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.employee_list')}}" class="nav-link @yield('employee-list')">
                  <i class="fas fa-solid fa-arrow-right nav-icon"></i>
                  <p>Employee List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @yield('type')">
            <a href="#" class="nav-link @yield('type-add')">
              <i class="fas fa-solid fa-list nav-icon"></i>
              <p>
                Leave Type
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('leave-type.index')}}" class="nav-link @yield('type-add')">
                <i class="fas fa-solid fa-arrow-right nav-icon"></i>
                  <p>Type List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @yield('application')">
            <a href="#" class="nav-link @yield('application-list')">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Leave Application
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('leave-application.index')}}" class="nav-link @yield('pending-list')">
                <i class="fas fa-solid fa-arrow-right nav-icon"></i>
                  <p>Pending List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.leave-approve-list')}}" class="nav-link @yield('approve-list')">
                <i class="fas fa-solid fa-arrow-right nav-icon"></i>
                  <p>Approved List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.leave-reject-list')}}" class="nav-link @yield('reject-list')">
                <i class="fas fa-solid fa-arrow-right nav-icon"></i>
                  <p>Rejected List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link">
            <i class="fas fa-solid fa-lock nav-icon"></i>
              <p class="logout-btn" style="cursor:pointer">
              Logout
              </p>
            </a>
          </li>

          <form method="POST" action="{{ route('logout') }}" id="logout-form">
                  @csrf
            </form>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>