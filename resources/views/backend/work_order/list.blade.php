@extends('backend.layout.master')
@section('pagetitle', 'Work Orders List')

@section('head')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <style>
    .badgecss {
    	color: #fff;
    	width: 100%;
    	padding: 10px;
    }
  </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Work Orders  @if(in_array('work_order.create', $groupsWithRoles))<a href="{{ route('work_order.create') }}"><button class="btn btn-primary">Add Work Order</button></a>@endif</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Work Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @include('backend.layout.messages')
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped mt-3">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Order No</th>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Staff Name</th>
                    <th>Client Name</th>
                    <th>Order Date</th>
                    <th>Type/Department</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($work_orders->isNotEmpty())
                    @foreach($work_orders as $key => $work_order)
                    @php 
                    $tmp = App\Models\User::find($work_order->staff_id);
                    $equipment_id = App\Models\EquipmentIssueLogging::find($work_order->equipmentissue_id)->equipment_id;
                    @endphp
                    @if(!empty($tmp))
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $work_order->department_no.'-'.$work_order->id ?? '' }}</td>
                    <td>{{ ucwords(App\Models\Equipment::find($equipment_id)->title) ?? ''}}</td>
                    <td style="vertical-align: middle;">@if($work_order->priority == 'highest') <span class="badge badge-danger">Highest</span>
                      @elseif($work_order->priority == 'high') <span class="badge badge-danger">High</span>
                      @elseif($work_order->priority == 'medium') <span class="badge badge-info">Medium</span>
                      @elseif($work_order->priority == 'low') <span class="badge badge-primary">Low</span>
                      @elseif($work_order->priority == 'lowest') <span class="badge badge-primary">Lowest</span>@endif</td>
                    <td>{{ ucwords($work_order->staff->name) ?? ''}}</td>
                    <td>{{ ucwords($work_order->client->name) ?? ''}}</td>
                    <td>{{ date('d M, Y h:i A', strtotime($work_order->orderdate)) ?? ''}}</td>
                    <td style="vertical-align: middle;"><div class="color-palette-set"><span class="badge color-palette badgecss" style="background: {{$work_order->department->colorbg ?? ''}};"> {{ $work_order->department_no ?? ''}}</span></div></td>
                    <td class="project-state" style="vertical-align: middle;"> 
                      @if($work_order->status == '0') <span class="badge badge-danger">Draft</span>
                      @elseif($work_order->status == '1') <span class="badge badge-danger">Cancelled</span>
                      @elseif($work_order->status == '2') <span class="badge badge-info bg-purple color-palette">Started</span>
                      @elseif($work_order->status == '3') <span class="badge badge-info">Pending</span>
                      @elseif($work_order->status == '4') <span class="badge badge-primary">Processing</span>
                      @elseif($work_order->status == '5') <span class="badge badge-success">Complete</span>@endif
                    </td>
                    <td class="project-actions" style="vertical-align: middle;">
                      @if(in_array('work_order.show', $groupsWithRoles))
                      <a class="btn btn-primary btn-sm" href="{{ route('work_order.show', $work_order->id) }}">
                        <i class="fas fa-eye"></i>  View
                      </a>
                      @endif
                      @if(in_array('work_order.edit', $groupsWithRoles))
                      <a class="btn btn-info btn-sm" href="{{ route('work_order.edit', $work_order->id) }}">
                        <i class="fas fa-pencil-alt"></i>  Edit
                      </a>
                      @endif
                      @if(in_array('work_order.destroy', $groupsWithRoles))
                      <form method="POST" action="{{ route('work_order.destroy', $work_order->id) }}" style="display: inline-block;">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="fas fa-trash"></i> Delete</button>
                      </form>
                      @endif
                      </td>
                  </tr>
                  @endif
                  @endforeach
                  @else
                  <tr>
                    <td colspan="10" class="text-center"><h4>No Data Found!</h4></td>
                  </tr>
                  @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- DataTables  & Plugins -->
<script src="{{ URL::asset('assests/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assests/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
 
      $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this work order?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection