<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDF</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="wrapper contanier py-5" style="margin: 5% 5%;">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header mb-3">
          <i class="fas fa-globe"></i> {{ config('app.name', 'Laravel') }}
          <small class="float-right">Date: {{date('d/m/Y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
   <!-- {!! QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!} -->
    <!-- /.row -->
    <table class="table table-striped" style="width:100%;">
        <tr>
            <td>
                <div class="invoice-col mb-4" style="width:100%;">
                    <h4><strong>Title: {{ ucwords($equipment->title) ?? '' }}</strong><br></h4>
                </div>
            </td>
            <td>
                <div class="invoice-col mb-4" style="width:30%;">
                    <img src="data:image/png;base64, {!! $qrcode !!}">
                </div>
            </td>
        </tr>
    </table>
    <!-- Table row -->
    <div class="row" style="margin-top:10%;">
        <div class="col-12 table-responsive">
            <table class="table table-striped" style="font-size: 20px;">
                <thead>
                    @foreach(json_decode($equipment->equipment_info, true) as $key => $value)
                    <tr>
                        <td><b>{{ucwords($key) ?? '-'}}</b></td>
                        <td>{{ucwords($value) ?? '-'}}</td>
                    </tr>
                    @endforeach
                </thead>
            </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

</body>
</html>