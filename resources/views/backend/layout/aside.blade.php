<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ URL::asset('assests/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IEMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if(Auth::user()->image)
        <img class="img-circle elevation-2" src="{{asset('/public/image/'. Auth::user()->image)}}" alt="User Image">
        @endif
        </div>
        <div class="info">
          <a href="{{ route('user.profile', Auth::user()->id)}}" class="d-block">{{ Auth::user()->name ?? ''}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @auth
          @role('admin|Super-Admin')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Users
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('addUser')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('roles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>UserRole</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('permissions.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-indent"></i>
              <p>
              Inventory
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('inventory.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('inventory.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Inventory</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole
          @role('Super-Admin|Staff|Client')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
              Work Order
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('work_order.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Work Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('work_order.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Work Order</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Reports
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employees.report')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employees Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('equipment.report')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Equipment Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('work_order.report')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Work Order Report</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole
          @endauth
          @auth
          <li class="nav-item">
            <a href="{{ route('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              {{auth()->user()->name}} Logout
              </p>
            </a>
          </li>
          @endauth
          
          @guest
          <li class="nav-item">
            <a href="{{ route('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout
              </p>
            </a>
          </li>
          @endguest
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>