@extends('backend.layout.master')
@section('pagetitle', 'Work Order Edit')

@section('head')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.css') }}">
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
              <li class="breadcrumb-item active">Work Order Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-12">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
          @endif
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit {{ ucwords($work_order->title) ?? ''}} Work Order Details</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('equipment_issues_order.update', $work_order->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="hidden" name="equipmentissueID" value="{{ $id ?? '' }}">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group {{ $errors->has('job_performed_by') ? 'has-error' : ''}}">
                            <label for="inputStaff">Job Performed By <span class="text-danger">*</span></label>
                            <select id="inputStaff" class="form-control" name="job_performed_by" required>
                                <option selected disabled>Select one</option>
                                @foreach($staffs as $val)
                                <option value="{{$val->id ?? ''}}" @if($work_order->job_performed_by == $val->id) selected @endif>{{ucwords($val->name) ?? ''}}</option>
                                @endforeach
                            </select>
                            @error('job_performed_by')
                            <span class="invalid-feedback" role="alert" style="display:block;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->has('remarks') ? 'has-error' : ''}}">
                            <label for="inputDescription">Remarks <span class="text-danger">*</span></label>
                            <textarea id="inputDescription" class="form-control" rows="3" name="remarks" required>{{ $work_order->remarks ?? ''}}</textarea>
                            @error('remarks')
                              <span class="invalid-feedback" role="alert" style="display:block;">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                        <label for="inputOrderdate">Start Date <span class="text-danger">*</span></label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" id="inputOrderdate" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="start_date" value="{{ date('d-m-Y h:i:s', strtotime($work_order->start_date)) ?? ''}}" required/>
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                      </div>
                      <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                        <label for="inputOrderdate">End Date <span class="text-danger">*</span></label>
                        <div class="input-group date" id="enddatetime" data-target-input="nearest">
                            <input type="text" id="inputOrderdate" class="form-control datetimepicker-input" data-target="#enddatetime" name="end_date" value="{{ date('d-m-Y h:i:s', strtotime($work_order->end_date)) ?? ''}}"/>
                            <div class="input-group-append" data-target="#enddatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-12">
                    <a href="{{ route('work_order.index') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Update work order" class="btn btn-success float-right">
                  </div>
                </div>
              </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- date-range-picker -->
<script src="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var orderDate = "{{ date('d/m/Y h:i A', strtotime($work_order->orderdate)) }}";
        
        //DateTime picker
        $('#reservationdatetime').datetimepicker({ 
            // format:'DD-MM-YYYY hh:mm:ss',
            icons: { time: 'far fa-clock' },
        });
        
        //DateTime picker
        $('#enddatetime').datetimepicker({ 
            // format:'DD-MM-YYYY hh:mm:ss',
            icons: { time: 'far fa-clock' },
        });

    });
</script>
@endsection