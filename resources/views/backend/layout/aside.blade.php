<aside class="main-sidebar @if(App\Http\Helpers\Helper::websetting('tsclr') == '1') sidebar-dark-primary elevation-4 @elseif(App\Http\Helpers\Helper::websetting('tsclr') == '2') sidebar-light-primary elevation-2  @else sidebar-dark-primary elevation-4 @endif ">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
     @if(!empty(App\Http\Helpers\Helper::websetting('logoimage')))
        <img src="{{asset(App\Http\Helpers\Helper::websetting('logoimage'))}}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" class="brand-image" style="opacity: .8">
     @else
      <img src="{{ URL::asset('assests/dist/img/AdminLTELogo.png') }}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" class="brand-image img-circle elevation-3" style="opacity: .8">
     @endif
      <span class="brand-text font-weight-500">{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if(Auth::user()->image)
        <img class="img-circle elevation-2" src="{{asset(Auth::user()->image)}}" alt="User Image">
        @endif
        </div>
        <div class="info">
          <a href="{{ route('user.profile', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name ?? ''}}</a>
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
          
          {!! App\Http\Helpers\Helper::navbar_menu(Auth::user()->roles->first()->name) !!}
          
          @endauth
          
          @auth
          <li class="nav-item">
            <a href="{{ route('user.profile', Auth::user()->id) }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
              My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout 
              </p>
            </a>
          </li>
          @endauth
          
          @guest
          <li class="nav-item">
            <a href="{{ route('user.profile', Auth::user()->id) }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
              My Account
              </p>
            </a>
          </li>
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