@extends('backend.layout.master')
@section('pagetitle', 'Work Order View')

@section('head')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Work Order Detail <a href="{{ route('work_order.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Work Order Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ucwords($workordertitle) ?? ''}}  <span class="description">Created - {{date('d F, Y H:i', strtotime($work_order->created_at))}}</span></h3>
          <div class="card-tools">Order Number:- {{$work_order->department_no.'-'.$work_order->id ?? ''}} </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                  @if(!empty($work_order->scope_of_work))
                  <div class="col-12">
                      <h4 class="mt-2">Scope Of Work</h4>
                      <hr>
                      <p>{{ucfirst($work_order->scope_of_work) ?? ''}}</p>
                  </div>
                  @endif
                  
                  @if($work_orders_meta->isNotEmpty())
                  <div class="col-12">
                      <h4 class="mt-2">Work Order Remarks</h4>
                      <hr>
                        <div class="row">
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped mt-3">
                                  <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Job Performed By</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Remarks</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($work_orders_meta as $key => $meta)
                                    @php 
                                    $tmp = App\Models\User::find($meta->job_performed_by);
                                    @endphp
                                    @if(!empty($tmp))
                                  <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucwords($tmp->name) ?? ''}}</td>
                                    <td>{{ date('d M, Y h:i A', strtotime($meta->start_date)) ?? ''}}</td>
                                    <td>@if($meta->end_date == '0000-00-00 00:00:00') - @else {{ date('d M, Y h:i A', strtotime($meta->end_date)) ?? ''}} @endif</td>
                                    <td>{{ ucwords($meta->remarks) ?? '' }}</td>
                                  </tr>
                                  @endif
                                  @endforeach
                                  </tbody>
                                </table>
                            </div>
                        </div>
                  </div>
                  @endif
                @if($images->isNotEmpty())
                <div class="col-12">
                  <h4 class="mt-2">Work Order Images</h4>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                    <div>
                  <div class="btn-group w-100 mb-2">
                    <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All Images </a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="0"> Before Work Images</a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> After Work Images</a>
                  </div>
                  <div class="mb-2">
                    <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                    <div class="float-right">
                      <select class="custom-select" style="width: auto;" data-sortOrder>
                        <option value="index"> Sort by Position </option>
                        <option value="sortData"> Sort by Custom Data </option>
                      </select>
                      <div class="btn-group">
                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="filter-container p-0 row">
                    @foreach($images as $val)
                    <div class="filtr-item col-sm-2" data-category="{{$val->type}}" data-sort="@if($val->type == '0') after @elseif($val->type == '1') before @endif sample">
                      <a href="{{ URL::asset($val->image.'?text='.$val->title) }}" data-toggle="lightbox" data-title="@if($val->type == '0') After @elseif($val->type == '1') Before @endif Work">
                        <img src="{{ URL::asset($val->image.'?text='.$val->title) }}" class="img-fluid mb-2" alt="{{$val->title ?? 'sample'}}"/>
                      </a>
                    </div>
                    @endforeach
                  </div>
                </div>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3><i class="fas fa-paint-brush"></i> {{ucwords($workordertitle) ?? ''}}</h3>
              @if(!empty($work_order->address))
              <p class="text-sm">Address <b class="d-block">{{$work_order->address ?? ''}}</b></p>
              @endif
              @if(!empty($work_order->description))
              <p class="text-muted">{{ucfirst($work_order->description) ?? ''}}</p>
              @endif
              <br>
              <div class="text-muted">
                <p class="text-sm">Client Name
                  <b class="d-block">{{ ucwords($work_order->client->name) ?? ''}}</b>
                </p>
                <p class="text-sm">Contact Person
                  <b class="d-block">{{ ucwords($work_order->staff->name) ?? ''}}</b>
                </p>
              </div>

              <!-- <h5 class="mt-5 text-muted">Project files</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                </li>
              </ul>
              <div class="text-center mt-5 mb-3">
                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
              </div> -->
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
<!-- Ekko Lightbox -->
<script src="{{ URL::asset('assests/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- Filterizr-->
<script src="{{ URL::asset('assests/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });

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