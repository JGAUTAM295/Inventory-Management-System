@extends('backend.layout.master')
@section('pagetitle', 'Equipment Add')

@section('head')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.css') }}">
  <style>
  .col {
    width: 50%;
    float: left;
  }
  </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add Equipment <a href="{{ route('inventory.show', $id) }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Equipment Add</li>
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
              <h3 class="card-title">Add Equipment Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('equipment.store',['id'=>$id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="row">
                    <div class="col-md-12 dynamicDiv">
                      <div class="form-group col">
                          <label for="inputTitle">Title <span class="text-danger">*</span></label>
                          <input type="text" id="inputTitle" class="form-control" name="title" required>
                        </div>
                      @if($cfs)
                        @foreach($cfs as $cf)
                        
                        <div class="form-group col">
                          <label for="inputName">{{ucwords($cf->name) ?? ''}}  @if($cf->input_required != "") <span class="text-danger">*</span> @endif</label>
                          @if($cf->input_field_type == 'Select')
                          
                          <select id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control custom-select" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" @if($cf->input_required != "") required @endif>
                            <option selected disabled>Select one</option>
                            @foreach(App\Models\Taxonomy::getTaxonomyData($cf->id) as $val)
                            <option value="{{$val->name ?? ''}}">{{ucwords($val->name) ?? ''}}</option>
                            @endforeach
                          </select>

                          @elseif($cf->input_field_type == 'Textarea')
                          
                          <textarea id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control" rows="3" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" placeholder="Enter ..." @if($cf->input_required != "") required @endif></textarea>
                     
                          @elseif($cf->input_field_type == 'Date')
                          
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control datetimepicker-input" data-target="#reservationdate" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" @if($cf->input_required != "") required @endif/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          
                          @elseif($cf->input_field_type == 'Number')
                          
                          <input type="number" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control {{strtolower($cf->input_field_type).'css'}}" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @elseif($cf->input_field_type == 'Text')
                          
                          <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control {{strtolower($cf->input_field_type).'css'}}" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @else
                          
                          <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @endif
                        </div>
                        @endforeach
                      @endif
                      
                      <div class="form-group col">
                        <label for="inputStatus">Status <span class="text-danger">*</span></label>
                        <select id="inputStatus" class="form-control custom-select" name="status">
                          <option selected disabled>Select one</option>
                          <option value="1">Active</option>
                          <option value="2">Deactive</option>
                        </select>
                      </div>
                    </div>
                </div> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-5">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new equipments" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- date-range-picker -->
<script src="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
          //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    });
</script>
@endsection