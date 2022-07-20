@extends('layouts.auth')

@section('content')
@if(session('global'))
  <div id="global_div" class="alert alert-success mb-1 mt-1">
    {{ session('global') }}
  </div>
@endif
<div class="login-box">
  <div class="login-logo">
     @if(!empty(App\Http\Helpers\Helper::websetting('logoimage')))
        <img src="{{asset(App\Http\Helpers\Helper::websetting('logoimage'))}}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" class="brand-image" style="opacity: .8; width: 100%;">
     @else
      <img src="{{ URL::asset('assests/dist/img/AdminLTELogo.png') }}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" class="brand-image img-circle elevation-3" style="opacity: .8; width: 100%;">
     @endif
     </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign In</p>
       @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        
        @if(session()->has('error'))
           <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        
      <form action="{{ route('login') }}" method="post">
      @csrf
      <input type="hidden" id="fcmtoken" name="token" value="">
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->
                                
      <p class="mb-1">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">I forgot my password</a>
        @endif
      </p>
      <!--<p class="mb-0">-->
      <!--  <a href="{{ route('register') }}" class="text-center">Register a new user</a>-->
      <!--</p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection

@section('footerscript')
<script>
setTimeout(function(){
  $('#global_div').remove();
}, 5000);
</script>
@endsection