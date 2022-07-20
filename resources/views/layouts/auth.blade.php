<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('assests/dist/css/adminlte.min.css') }}">
      <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    
    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-functions.js"></script>
    
    <!-- firebase integration end -->
    
    <!-- Comment out (or don't include) services that you don't want to use -->
     <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-storage.js"></script> 
    
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-analytics.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('assests/plugins/toastr/toastr.min.css') }}">
</head>
<body class="hold-transition @if(request()->segment(count(request()->segments())) == 'register'){{request()->segment(count(request()->segments())).'-page'}}@else login-page @endif">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

<!-- jQuery -->
<script src="{{ URL::asset('assests/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('assests/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('assests/dist/js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('firebase-messaging-sw.js') }}"></script>
<script src="{{ URL::asset('assests/js/firebase-notification.js') }}"></script>
</body>
</html>
