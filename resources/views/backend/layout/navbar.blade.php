<nav class="main-header navbar navbar-expand @if(App\Http\Helpers\Helper::websetting('tsclr') == '1') navbar-dark @elseif(App\Http\Helpers\Helper::websetting('tsclr') == '2') navbar-light  @else navbar-dark @endif">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li>
      @if(Auth::user()->hasRole('Staff|Client'))
       <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard.contactindex') }}" class="nav-link">Contact</a>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
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
      </li> -->

      <!-- Messages Dropdown Menu -->
       {!! App\Http\Helpers\Helper::getLatestMails() !!} 
      
      <!-- Notifications Dropdown Menu -->
      {!! App\Http\Helpers\Helper::getnotification() !!} 
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>