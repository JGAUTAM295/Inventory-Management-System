)@extends('backend.layout.master')
@section('pagetitle', 'Equipment Edit')

@section('head')
 <!-- daterange picker -->
 <link rel="stylesheet" href="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.css') }}">
 <!-- Ekko Lightbox -->
 <link rel="stylesheet" href="URL::asset('assests/plugins/ekko-lightbox/ekko-lightbox.css') }}">
 <style>
  .col {
    width: 50%;
    float: left;
  }
  .wrapper 
  {
      position: absolute!important;
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
          <form action="{{ route('equipment.update', ['id'=>$inventory->id,'eid'=>$equipment->id]) }}" method="POST" enctype="multipart/form-data">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Equipment Details</h3>
            </div>
            <div class="card-body">
                @method('patch')
                @csrf
                <input type="hidden" name="id" value="{{ $inventory->id ?? '' }}">
                <div class="row">
                  <div class="col-md-12 dynamicDiv">
                      <div class="form-group col">
                        <label for="inputTitle">Title <span class="text-danger">*</span></label>
                        <input type="text" id="inputTitle" class="form-control" name="title" value="{{$equipment->title ?? ''}}" required>
                      </div>
                      <!-- cost_(afl_) -->
                      @if(!empty($cfs))
                        @foreach($cfs as $cf)
                        @php $colname = $cf->slug.'='.$cf->id; @endphp
                        <!-- @ if($jsonEquipment[$colname] === $colname) -->
                        <div class="form-group col">
                          <label for="inputName">{{ucwords($cf->name) ?? ''}}  @if($cf->input_required != "") <span class="text-danger">*</span> @endif</label>
                          @if($cf->input_field_type == 'Select')
                          <select id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control custom-select" name="{{$cf->slug.'='.$cf->id ?? ''}}" @if($cf->input_required != "") required @endif>
                            <option selected disabled>Select one</option>
                            @foreach(App\Models\Taxonomy::getTaxonomyData($cf->id) as $val)
                            <option value="{{$val->name ?? ''}}" @if($jsonEquipment[$colname] == $val->name) selected @endif>{{ucwords($val->name) ?? ''}}</option>
                            @endforeach
                          </select>

                          @elseif($cf->input_field_type == 'Textarea')
                          
                          <textarea id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control" rows="3" name="{{$cf->slug.'='.$cf->id ?? ''}}" placeholder="Enter ..." @if($cf->input_required != "") required @endif>{{$jsonEquipment[$colname] ?? ''}}</textarea>
                          
                          @if(str_contains($jsonEquipment[$colname], 'iframe'))
                          {!! $jsonEquipment[$colname] ?? '' !!}
                          @endif
                     
                          @elseif($cf->input_field_type == 'Date')
                          
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control datetimepicker-input" data-target="#reservationdate" name="{{$cf->slug.'='.$cf->id ?? ''}}" value="{{$jsonEquipment[$colname] ?? ''}}" @if($cf->input_required != "") required @endif/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>

                          @elseif($cf->input_field_type == 'Number')
                          
                          <input type="number" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control {{strtolower($cf->input_field_type).'css'}}" name="{{$cf->slug.'='.$cf->id ?? ''}}" value="{{$jsonEquipment[$colname] ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @elseif($cf->input_field_type == 'File')
                          
                          @if(!empty($jsonEquipment[$colname]))
                          
                          @php $filePath = urldecode(url('/public', $jsonEquipment[$colname])); @endphp
                          
                          @if(pathinfo($filePath, PATHINFO_EXTENSION) == 'pdf')
                            <br>
                            <a class="btn btn-primary btn-sm mb-2" href="{{ urldecode(url('/public', $jsonEquipment[$colname])) }}" target="_blank">
                              <i class="fas fa-file-pdf"></i> View PDF
                            </a>
                          @endif
                          
                          @if(pathinfo($filePath, PATHINFO_EXTENSION) == 'jpg' || pathinfo($filePath, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($filePath, PATHINFO_EXTENSION) == 'png')
                          <br>
                            <a href="{{asset($jsonEquipment[$colname])}}" data-toggle="lightbox" data-gallery="{{$cf->name ?? '' }}">
                              <img src="{{asset($jsonEquipment[$colname])}}" class="img-fluid mb-2" alt="Equipment Image" style="width: 26%;">
                            </a>
                          @endif
                          
                          @endif
                          
                          <input type="file" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control {{strtolower($cf->input_field_type).'css'}}" name="{{$cf->slug.'='.$cf->id ?? ''}}" value="{{$jsonEquipment[$colname] ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          
                          @elseif($cf->input_field_type == 'Text')
                          
                          <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control {{strtolower($cf->input_field_type).'css'}}" name="{{$cf->slug.'='.$cf->id ?? ''}}" value="{{$jsonEquipment[$colname]?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @else
                          
                          <input type="text" id="input{{strtolower(str_replace(' ', '_', $cf->name)) ?? ''}}" class="form-control" name="{{$cf->slug.'='.$cf->id ?? ''}}" value="{{$jsonEquipment[$colname] ?? ''}}" @if($cf->input_required != "") required @endif>
                          
                          @endif
                        </div>
                        <!-- @ endif -->
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
              
            <!-- /.card-body -->
            </div>
          <!-- /.card -->
          </div>
          <div class="row">
            <div class="col-12">
                <a href="{{ route('inventory.show', $inventory->id) }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Update Equipment" class="btn btn-success float-right">
            </div>
          </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- date-range-picker -->
<script src="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ URL::asset('assests/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
          //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    });
    
    $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  })
</script>
@endsection