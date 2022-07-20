<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
 
    @if(!empty(App\Http\Helpers\Helper::websetting('faviconimage')))
    <link rel="icon" type="image/png" href="{{asset(App\Http\Helpers\Helper::websetting('faviconimage'))}}"/>
    @else
     <link rel="icon" type="image/png" href="{{ URL::asset('assests/dist/img/AdminLTELogo.png') }}"/>
    @endif

  <title>{{ config('app.name', 'Laravel') }} @yield('pagetitle')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('assests/dist/css/adminlte.min.css') }}">
  
    <!-- Firebase App is always required and must be first -->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase.js"></script>-->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>-->
    
    <!-- Add additional services that you want to use -->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>-->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>-->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script>-->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>-->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-functions.js"></script>-->
    
    <!-- firebase integration end -->
    
    <!-- Comment out (or don't include) services that you don't want to use -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-storage.js"></script> -->
    
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-analytics.js"></script>-->
    <link rel="stylesheet" href="{{ URL::asset('assests/plugins/toastr/toastr.min.css') }}">

  @yield('head')
</head>
<body id="{{'pageid-'.request()->segment(count(request()->segments()))}}" class="pjmt old-transition sidebar-mini layout-fixed {{request()->segment(count(request()->segments())).'-pagecss'}}">
    
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            @if(!empty(App\Http\Helpers\Helper::websetting('faviconimage')))
            <img class="animation__wobble" src="{{asset(App\Http\Helpers\Helper::websetting('faviconimage'))}}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" height="60" width="60">
            @else
            <img class="animation__wobble" src="{{ URL::asset('assests/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            @endif
        </div>
        <!-- Navbar -->
        @include('backend.layout.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.layout.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper px-5">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('backend.layout.right_aside')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>
            @if(!empty(App\Http\Helpers\Helper::websetting('copyright')))
            {{App\Http\Helpers\Helper::websetting('copyright') ?? ''}}
            @else
            Copyright &copy; 2022 <a href="{{ url('/') }}">IEMS</a>.
            All rights reserved.
            @endif
            </strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ URL::asset('assests/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('assests/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap -->
<script src="{{ URL::asset('assests/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('assests/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ URL::asset('assests/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('assests/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('assests/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::asset('assests/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ URL::asset('assests/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('assests/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ URL::asset('assests/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ URL::asset('assests/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('assests/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('assests/dist/js/pages/dashboard.js') }}"></script>
<!--<script src="{{ URL::asset('firebase-messaging-sw.js') }}"></script>-->
<!--<script src="{{ URL::asset('assests/js/firebase-notification.js') }}"></script>-->
<script src="{{ URL::asset('assests/plugins/toastr/toastr.min.js') }}"></script>
<script>
    /*** add active class and stay opened when selected ***/
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).addClass('active');

// for the treeview
$('ul.nav-treeview a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    // $(document).ready(function() {
    //     function disableBack() {
    //         window.history.forward()
    //     }
    //     window.onload = disableBack();
    //     window.onpageshow = function(e) {
    //         if (e.persisted)
    //             disableBack();
            
    //     }
    // });
</script>
@yield('footerscript')
</body>
</html>
