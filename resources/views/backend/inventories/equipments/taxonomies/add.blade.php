@extends('backend.layout.master')
@section('pagetitle', 'Custom Field Add')

@section('head')

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
                        </select>
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
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new custom field" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<script>
  $(document).ready(function() 
  {
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