@extends('backend.layout.master')
@section('pagetitle', 'Custom Fields List')

@section('head')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Custom Fields 
              <a href="{{ route('taxonomy.create') }}"><button class="btn btn-primary">Add Custom Field</button></a>
              <a href="{{ route('inventory.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Custom Fields</li>
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
                    <th>Name</th>
                    <th>Input Field Type</th>
                    <th>Form Input Field Order</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($taxonomies)
                    @foreach($taxonomies as $key => $taxonomy)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ucwords($taxonomy->name) ?? ''}} @if($taxonomy->input_required != "") <span class="text-danger">*</span> @endif</td>
                    <td>{{$taxonomy->input_field_type ?? ''}} </td>
                    <td>{{$taxonomy->order_no ?? ''}} </td>
                    <td class="project-state"> @if($taxonomy->status == '1') <span class="badge badge-success">Active</span>@elseif($taxonomy->status == '2') <span class="badge badge-danger">Deactive</span>@endif</td>
                    <td class="project-actions">
                      @if($taxonomy->input_field_type == 'Select')
                      <a class="btn btn-primary btn-sm" href="{{ route('taxonomy.show', $taxonomy->id) }}">
                        {!! App\Models\Taxonomy::checkTDexits($taxonomy->id) ?? '<i class="fas fa-plus"></i> Add Data' !!}
                      </a>
                      @endif
                      <a class="btn btn-info btn-sm" href="{{ route('taxonomy.edit', $taxonomy->id) }}">
                          <i class="fas fa-pencil-alt"></i>  Edit
                      </a>
                      <form method="POST" action="{{ route('taxonomy.destroy', $taxonomy->id) }}" style="display: inline-block;">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="fas fa-trash"></i>Delete</button>
                      </form>
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
              title: `Are you sure you want to delete this custom field?`,
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