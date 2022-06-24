@extends('backend.layout.master')
@section('pagetitle', 'Equipment Edit')

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
            <h3>Equipment Detail <a href="{{ route('inventory.show', $inventory->id) }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Equipment Edit</li>
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
              <h3 class="card-title">Edit Equipment Details</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('equipment.update', ['id'=>$inventory->id,'eid'=>$equipment->id]) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="hidden" name="id" value="{{ $inventory->id ?? '' }}">
                <div class="row">


                <div class="col-md-12 dynamicDiv">
                      @if($cfs)
                        @foreach($cfs as $cf)
                        @foreach(json_decode($equipment->equipment_info, true) as $key => $value)
                        @if ($key == strtolower(str_replace(' ', '_', $cf->name))) 
                        <div class="form-group col">
                          <label for="inputTitle">Title <span class="text-danger">*</span></label>
                          <input type="text" id="inputTitle" class="form-control" name="title" value="{{$equipment->title ?? ''}}" required>
                        </div>
                      
                        <div class="form-group col">
                          <label for="inputName">{{ucwords($cf->name) ?? ''}}  @if($cf->input_required != "") <span class="text-danger">*</span> @endif</label>
                          @if($cf->input_field_type == 'Select')
                          
                          <select id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control custom-select" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" @if($cf->input_required != "") required @endif>
                            <option selected disabled>Select one</option>
                            @foreach(App\Models\Taxonomy::getTaxonomyData($cf->id) as $val)
                            <option value="{{$val->name ?? ''}}" @if($value == $val->name) selected @endif>{{ucwords($val->name) ?? ''}}</option>
                            @endforeach
                          </select>

                          @elseif($cf->input_field_type == 'Textarea')
                          
                          <textarea id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control" rows="3" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" placeholder="Enter ..." @if($cf->input_required != "") required @endif>{{$value ?? ''}}</textarea>
                     
                          @elseif($cf->input_field_type == 'Date')
                          
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control datetimepicker-input" data-target="#reservationdate" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" value="{{$value ?? ''}}" @if($cf->input_required != "") required @endif/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          
                          @elseif($cf->input_field_type == 'Text' || $cf->input_field_type == 'Number')
                          
                          <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control {{strtolower($cf->input_field_type).'css'}}" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" value="{{$value ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @else
                          
                          <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control" name="{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" value="{{$value ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @endif
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                      @endif
                      
                      <div class="form-group col">
                        <label for="inputStatus">Status <span class="text-danger">*</span></label>
                        <select id="inputStatus" class="form-control custom-select" name="status">
                          <option selected disabled>Select one</option>
                          <option value="1" @if($equipment->status == '1') selected @endif>Active</option>
                          <option value="2" @if($equipment->status == '2') selected @endif>Deactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Update Equipment" class="btn btn-success float-right">
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
          //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    });
</script>
@endsection