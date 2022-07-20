@extends('backend.layout.master')
@section('pagetitle', 'Equipment List')

@section('head')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <style>
    .form-group input[type="file"] {
      float: none!important;
      width: 20%;
    }
  </style>
@endsection

@section('content')

    <!-- Content Header (Page header) {{ route('equipment.import', ['id'=>$inventory->id]) }}-->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Equipments 
            @if(in_array('equipment.create', $groupsWithRoles)) <a href="{{ route('equipment.create',['id'=>$inventory->id]) }}"><button class="btn btn-primary">Add Equipment</button></a> @endif
            @if(in_array('taxonomy.index', $groupsWithRoles)) <a href="{{ route('taxonomy.index') }}"><button class="btn btn-primary">Custom Fields</button></a> @endif
            @if(in_array('equipment.export', $groupsWithRoles)) <a href="{{ route('equipment.export', ['id'=>$inventory->id]) }}"><button class="btn btn-primary">Export</button></a>@endif
            @if(in_array('equipment.import', $groupsWithRoles)) <a href="#" id="import_box"><button class="btn btn-primary">Import</button></a>@endif
            <a href="{{ route('inventory.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Equipments</li>
            </ol>
          </div>

          <div id="importdiv" class="col-xl-12 col-md-12 col-12 mt-4" style="display:none;">
            @if(Session::has("success"))
            <div class="alert alert-success alert-primary alert-dismissible fade show " role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  <span class="sr-only">Close</span>
              </button>
              <strong>Success!</strong> {{Session::get("success")}}
            </div>
            @elseif(Session::has("failed"))
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  <span class="sr-only">Close</span>
              </button>
              {{Session::get("failed")}}
            </div>
            @endif

            <form method="post" action="{{route('equipment.import', ['id'=>$inventory->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="card shadow text-center">
                    <div class="card-body">
                        <div class="form-group" style="display: ruby;">
                            <label>Select file in csv format: </label>
                            <input type="file" name="csv_file" class="form-control"  accept=".csv">
                            <button type="submit" class="btn btn-success" name="submit">Import Equipment Data </button>
                        </div>
                    </div>
                </div>
            </form>
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
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($equipments)
                    @foreach($equipments as $key => $equipment)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ucwords($equipment->title) ?? ''}}</td>
                    <td class="project-state"> @if($equipment->status == '1') <span class="badge badge-success">Active</span>@elseif($equipment->status == '2') <span class="badge badge-danger">Deactive</span>@endif</td>
                    <td class="project-actions">
                      @if(in_array('equipment.getQRCode', $groupsWithRoles))
                      <a class="btn btn-secondary btn-sm" href="{{route('equipment.getQRCode',['id'=>$inventory->id,'eid'=>$equipment->id])}}" target="_blank">
                        <i class="fa fa-qrcode" aria-hidden="true"></i> View QR Code
                      </a>
                      @endif
                      @if(in_array('equipment.downloadPDF', $groupsWithRoles))
                      <a class="btn btn-primary btn-sm" href="{{route('equipment.downloadPDF',['id'=>$inventory->id,'eid'=>$equipment->id])}}" target="_blank">
                        <i class="fas fa-file-pdf"></i> View PDF
                      </a>
                      @endif
                      @if(in_array('equipment.edit', $groupsWithRoles))
                      <a class="btn btn-info btn-sm" href="{{ route('equipment.edit',['id'=>$inventory->id,'eid'=>$equipment->id]) }}">
                          <i class="fas fa-pencil-alt"></i> Edit
                      </a>
                      @endif
                      @if(in_array('equipment.destroy', $groupsWithRoles))
                      <form method="POST" action="{{ route('equipment.destroy',['id'=>$inventory->id,'eid'=>$equipment->id]); }}" style="display: inline-block;">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="fas fa-trash"></i>Delete</button>
                      </form>
                      @endif
                      </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6">No Data Found!</td>
                  </tr>
                  @endif
                  </tfoot>
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
          title: `Are you sure you want to delete this equipment?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
          buttons: ['No, cancel it!', 'Yes, I am sure!'],
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
      // "buttons": ["copy", "csv", "excel", "pdf", "print"]
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

    $('#import_box').click(function() {
        $('#importdiv').toggle();
        return false;
    });        
   });
</script>

@endsection