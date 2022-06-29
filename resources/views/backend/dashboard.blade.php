@extends('backend.layout.master')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$neworders ?? '0'}}</h3>

                <p>New Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$count_Inventories ?? '0'}}</h3>

                <p>Total Inventores</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('inventory.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$count_staff ?? '0'}}</h3>

                <p>Total Staff</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('staffsUser') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$count_client ?? '0'}}</h3>
                <p>Total Client</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('clientUser') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Monthy Orders
                </h3>

              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Users card -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-users mr-1"></i>
                  Users
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-calendar-alt"></i>
                    </button>
                    <select name="select" id="nameselect" class="float-right btn-primary border-5" role="menu">
                        @foreach (range(date('Y'), 2011) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                      </select>
                  </div>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="Highchartscontainer"></div>
              </div>
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card"  style="display:none;">
       
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

            <!-- /.card -->
            <!-- solid Work Order graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Work Order Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-3 text-center">
                    <input type="text" class="knob" data-readonly="true" value="{{$cancel_orders[0]['count_cancel'] ?? '0'}}" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">{{ucfirst($cancel_orders[0]['status'] ?? 'Cancel')}} Order</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-3 text-center">
                    <input type="text" class="knob" data-readonly="true" value="{{$pending_orders[0]['count_pending'] ?? '0'}}" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">{{ucfirst($pending_orders[0]['status'] ?? 'Pending')}} Order</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-3 text-center">
                    <input type="text" class="knob" data-readonly="true" value="{{$processing_orders[0]['count_processing'] ?? '0'}}" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">{{ucfirst($processing_orders[0]['status'] ?? 'Processing')}} Order</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-3 text-center">
                    <input type="text" class="knob" data-readonly="true" value="{{$complete_orders[0]['count_complete'] ?? '0'}}" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">{{ucfirst($complete_orders[0]['status'] ?? 'Complete')}} Order</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  
                  <a id="addWorkOrder" href="{{ route('work_order.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus mx-2"></i> Add new work order</a>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('footerscript')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    // Sales chart
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');
  
  var salesChartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Work Orders',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: <?php echo $order_monthwise; ?>
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'bar',
    data: salesChartData,
    options: salesChartOptions
  })
   //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutData = {
      labels: [
          'Canceled',
          'Pending',
          'Processing',
          'Complete',
      ],
      datasets: [
        {
          
          data: [{{$cancel_orders[0]['count_cancel'] ?? '0'}},{{$pending_orders[0]['count_pending'] ?? '0'}},{{$processing_orders[0]['count_processing'] ?? '0'}},{{$complete_orders[0]['count_complete'] ?? '0'}}],
          backgroundColor : ['#f56954', '#f39c12', '#00c0ef', '#00a65a'],
          // borderColor: ['#f56954', '#f39c12', '#00c0ef', '#00a65a'],
        }
      ]
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

  const chart = Highcharts.chart('Highchartscontainer', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Client and Staff users'
      },
      subtitle: {
          text: ''
      },
      xAxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
              'Oct', 'Nov', 'Dec'
          ]
      },
      yAxis: {
          title: {
              text: 'Users'
          }
      },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
          }
      },
      series: [{
          name: 'Client',
          data: <?php echo json_encode($clientUserForChart); ?>
      }, {
          name: 'Stafff',
          data: <?php echo json_encode($staffUserForChart); ?>
      }]
  });
  
  $(document).on('change', '#nameselect', function() {
    
    var value = this.value;

    $.ajax({
      url: "/clientStaff/"+value,
      type: "get",
      data: {
        year: value,
      },
      success: function(response) {
        chart.series[0].update({
          data: response.active
        });
        chart.series[1].update({
            data: response.trial
        });
      },
    });
  });
</script>
@endsection