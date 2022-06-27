<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} @yield('pagetitle')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('assests/dist/css/adminlte.min.css') }}">
  <style>
  .qrcode_title{
	float: inherit;
	font-size: 1.5rem;
	font-weight: 800;
  }
  </style>
</head>
<body>
<div class="wrapper contanier py-5" style="margin: 5% 38%;">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary text-center mb-0">
              <div class="card-header text-center">
                <h2 class="main-heading">SCAN TO VIEW</h2>
              </div>
              <div class="card-body">
                <h4 class="card-title qrcode_title mb-3">{{ucwords($equipment->title) ?? ''}}</h4>
                <div class="qr-code"> {!! str_replace('<?xml version="1.0" encoding="UTF-8"?>','',QrCode::size(170)->generate(route('equipment.downloadPDF',['id'=>$inventory->id,'eid'=>$equipment->id]))); !!}</div>
              </div>
              <div class="card-footer">
              <p class="inner-text">Use your phone camera or QR scanner app to scan QR.</p>
              </div>
            </div>
        </div>













      <!-- /.col -->
    </div>



    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script>
  window.print();
  </script>
</body>
</html>