@extends('backend.layout.master')
@section('pagetitle', 'Contact Form Message')

@section('head')
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/toastr/toastr.min.css') }}">
@endsection
@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Contact Form Message <a href="{{ route('dashboard.mail') }}"><button class="btn btn-primary">Back</button></a></h3>
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
            <div class="card-header">
              <h3 class="card-title">Read Mail</h3>
              
               <div class="card-tools">
                    @if(in_array('dashboard.destorymail', $groupsWithRoles))
                    <form method="POST" action="{{ route('dashboard.destorymail', $mail->id) }}" style="display: inline-block;">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-tool btn-default btn-sm btn-sm show_confirm" data-container="body" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    @endif
                    @if(empty($adminmail))
                    <button type="button" class="btn btn-tool btn-default btn-sm reply_mail" data-container="body" title="Reply"><i class="fas fa-reply"></i></button>
                    @endif
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>{{ucwords($mail->title) ?? ''}}</h5>
                <h6>From: {{App\Models\User::find($mail->user_id)->email ?? ''}}
                  <span class="mailbox-read-time float-right">{{date('d M Y, h:i A', strtotime($mail->created_at)) ?? ''}}</span></h6>
              </div>
            
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                {!! $mail->email_msg !!}
              </div>
              <!-- /.mailbox-read-message -->
             
             @if(!empty($adminmail)) 
            <!-- /.Admin mailbox-controls -->
              <div class="mailbox-read-message">
                  <hr>
                  <h5>Admin Reply</h5>
                  <hr>
                {!! $adminmail->email_msg !!}
              </div>
              @endif
              <div id="adminreply" class="mailbox-read-message"></div>
            </div>
            @if(in_array('dashboard.replymessage', $groupsWithRoles))
            @if(empty($adminmail) && $mail->type != 'job_order_reported')
            <div id="replymaildiv" class="card-footer py-5 mt-2">
                <form id="contactForm">
                    <input type="hidden" id="id" name="id" value="{{$mail->id}}">
                    <input type="hidden" id="email" name="email" value="{{App\Models\User::find($mail->user_id)->email}}">
                    <div class="col-md-12">
                        <div class="input-group">
                            <textarea id="inputMessage" class="form-control" rows="3" placeholder="Enter message..." ></textarea>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            @endif
            @endif
            
            @if(in_array('dashboard.replymessage', $groupsWithRoles))
            @if(empty($adminmail) && $mail->type != 'new_job_order')
            <div id="replymaildiv" class="card-footer py-5 mt-2">
                <form id="contactForm">
                    <input type="hidden" id="id" name="id" value="{{$mail->id}}">
                    <input type="hidden" id="email" name="email" value="{{App\Models\User::find($mail->user_id)->email}}">
                    <div class="col-md-12">
                        <div class="input-group">
                            <textarea id="inputMessage" class="form-control" rows="3" placeholder="Enter message..." ></textarea>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            @endif
            @endif
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
<script src="{{ URL::asset('assests/plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(".reply_mail").click(function () {
        $("#replymaildiv").toggle();
    });
    
     //Send Message
  $('#contactForm').on('submit', function(e) {
    e.preventDefault();
    var id = $('#id').val();
    var email = $('#email').val();
    var message = $('#inputMessage').val();
    
      $.ajax({
          type: "POST",
          url: '{{route("dashboard.replymessage")}}',
          data: {id:id, email:email, message:message},
          headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
          },
          success: function(response)
          {
            console.log(response);
              if(response.status == '200')
              {
                toastr.success(response.data);
                $("#inputMessage").val('');
                $("#adminreply").empty().html('<hr><h5>Admin Reply</h5><hr>'+ response.message);
                $("#replymaildiv").hide();
                $(".reply_mail").hide();
              }
              else
              {
                if(response.data !='')
                {
                  toastr.error(response.data);
                }
                else
                {
                  toastr.error('Message Not Sent. Please try again later!');
                }
                
              }
           }
      });
  });
    
//  delete-mail
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