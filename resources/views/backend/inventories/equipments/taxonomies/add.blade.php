@extends('backend.layout.master')
@section('pagetitle', 'Custom Field Add')

@section('head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
  .select2-container--default .select2-selection--multiple {
    background-color: transparent!important;
    border: 1px solid #6c757d!important;
    color: #fff!important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3f6791!important;
    border-color: #3f6791!important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff!important;
}
input.select2-search__field::placeholder {
    color: #fff!important;
}
</style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add Custom Field <a href="{{ route('taxonomy.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Custom Field Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Custom Field Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('taxonomy.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                          <label for="inputName">Name <span class="text-danger">*</span></label>
                          <input type="text" id="inputName" class="form-control" name="name" required>
                          @error('name')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group {{ $errors->has('input_field_type') ? 'has-error' : ''}}">
                        <label for="input_type">Input Field Type <span class="text-danger">*</span></label>
                        <select id="input_type" class="form-control custom-select" name="input_field_type" required>
                          <option selected disabled>Select one</option>
                          <option value="Text">Text</option>
                          <option value="Textarea">Textarea</option>
                          <option value="Date">Date</option>
                          <option value="Number">Number</option>
                          <option value="Select">Select</option>
                          <option value="File">File</option>
                        </select>
                        <div id="FileValid" class="mt-2" style="display:none">
                            <label for="file_accept">File Accept Validation<span class="text-danger">*</span></label>
                            <select id="file_accept" class="form-control select2" name="file_accept[]" multiple="multiple" data-placeholder="Select one" style="width: 100%;">
                                <option value="png">PNG</option>
                                <option value="jpg">JPG</option>
                                <option value="jpeg">JPEG</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        @error('input_field_type')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div id="input_req" class="form-group {{ $errors->has('input_required') ? 'has-error' : ''}}">
                        <input type="hidden" name="input_required" value="0">
                        <label for="inputName" data-labelfor="input_required" class="my-4"><input type="checkbox" name="input_required" value="1" class="mx-2"> Input Field Required</label>
                        @error('input_required')
                        <span class="invalid-feedback" role="alert" style="display:block;">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>    
                    <div class="col-md-6">
                    <div class="form-group {{ $errors->has('order_no') ? 'has-error' : ''}}">
                        <label for="inputOrder">Input Field Order <span class="text-danger">*</span></label>
                        <input type="number" id="inputOrder" class="form-control" name="order_no" required>
                        @error('order_no')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    
                      <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                          <label for="inputStatus">Status <span class="text-danger">*</span></label>
                          <select id="inputStatus" class="form-control custom-select" name="status">
                          <option selected disabled>Select one</option>
                          <option value="1">Active</option>
                          <option value="2">Deactive</option>
                      </select>
                      @error('status')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
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
        <div class="col-12">
          <a href="{{ route('taxonomy.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new custom field" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- Select2 -->
<script src="{{ URL::asset('assests/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function() 
  {
    //Initialize Select2 Elements
    $('.select2').select2();
  
    $('#input_type').change(function(){
        if($(this).val() == 'File')
        {
            $('#' + $(this).val()+'Valid').show();
        }
        else
        {
            $('#FileValid').hide();
        }
    });

    $('#input_req label').bind('click',function(){
      var input = $(this).find('input');  
      if(input.prop('checked'))
      {
        input.prop('checked',false);
      }
      else
      {
        input.prop('checked',true);
      }
    });
  });
</script>
@endsection