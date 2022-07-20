@extends('backend.layout.master')
@section('pagetitle', 'Contact Form Message')

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
            <h3>Contact Form Message <a href="{{ route('dashboard') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Contact Form Message</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive mailbox-messages">
                <table id="example1" class="table table-hover">
                  <thead>
                  <tr>
                     @if(in_array('dashboard.destorymail', $groupsWithRoles))
                    <th></th>
                    @endif
                    <th>Name</th>
                    <th>Message</th>
                    <th>Message Date Time</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($mails as $key => $mail)
                      
                      <tr
                       @if(Auth::user()->hasRole('admin|Super-Admin')) @if($mail->read_at == '1') style="background-color: rgba(0, 239, 251, 0.10);" @else style="background-color: #fff" @endif  @endif
                      
                       @if(Auth::user()->hasRole('Staff|Client')) @if($mail->read_at == '1') style="background-color: rgba(0, 239, 251, 0.10);" @else style="background-color: #fff" @endif  @endif
                        >
                        @if(in_array('dashboard.destorymail', $groupsWithRoles))
                        <td>
                          <div class="icheck-primary">
                            <form method="POST" action="{{ route('dashboard.destorymail', $mail->id) }}" style="display: inline-block;">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="fas fa-trash"></i></button>
                             </form>
                          </div>
                        </td>
                        @endif
                        <td class="mailbox-name"><a href="{{ route('dashboard.readmail', $mail->id) }}">{{App\Models\User::find($mail->user_id)->name ?? ''}}</a></td>
                        <td class="mailbox-subject"><b>{{ucwords($mail->title) ?? ''}}</b> - {{ Str::limit($mail->message, $limit = 150, $end = '...') }}</td>
                        <td class="mailbox-date">{{date('d M Y, h:i A', strtotime($mail->created_at)) ?? ''}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
           
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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

<script>
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this mail?`,
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