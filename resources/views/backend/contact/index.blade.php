@extends('backend.layout.master')
@section('pagetitle', 'Contact Us')

@section('head')
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Contact Us <a href="{{ route('dashboard') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Contact Us</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row py-5">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
                <a href="{{ url('/') }}">
                    @if(!empty(App\Http\Helpers\Helper::websetting('logoimage')))
                        <img src="{{asset(App\Http\Helpers\Helper::websetting('logoimage'))}}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" style="opacity: .8">
                    @else
                      <img src="{{ URL::asset('assests/dist/img/AdminLTELogo.png') }}" alt="{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}" class="img-circle elevation-3" style="opacity: .8">
                    @endif
                      <br><br>
                      <h2><strong>{{App\Http\Helpers\Helper::websetting('sitename') ?? 'IEMS'}}</strong></h2>
                </a>
          </div>
          <div class="col-7">
            <form id="contactForm">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputMessage">Subject</label>
                      <input type="text" id="inputSubject" class="form-control" name="title" placeholder="Enter title or subject">
                    </div>
                    <div class="form-group">
                    <label for="inputMessage">Message</label>
                      <textarea id="inputMessage" class="form-control" rows="4" placeholder="Enter message..." ></textarea>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Send message">
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<script src="{{ URL::asset('assests/plugins/toastr/toastr.min.js') }}"></script>
<script>
  //Send Message
  $('#contactForm').on('submit', function(e) {
    e.preventDefault();
    var title = $('#inputSubject').val();
    var message = $('#inputMessage').val();
    
      $.ajax({
          type: "POST",
          url: '{{route("dashboard.contactstore")}}',
          data: {title:title, message:message},
          headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
          },
          success: function(response)
          {
            console.log(response);
              if(response.status == '200')
              {
                toastr.success(response.data);
                $("#contactForm")[0].reset();
                
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
</script>
@endsection