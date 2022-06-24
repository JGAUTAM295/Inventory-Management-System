@extends('backend.layout.master')
@section('pagetitle', 'Custom Field Edit')

@section('head')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Custom Field Detail <a href="{{ route('taxonomy.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Custom Field Edit</li>
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
              <h3 class="card-title">Edit {{ ucwords($taxonomy->title) ?? ''}} Custom Field Details</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('taxonomy.update', $taxonomy->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="hidden" name="id" value="{{ $taxonomy->id ?? '' }}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="inputName">Name <span class="text-danger">*</span></label>
                        <input type="text" id="inputName" class="form-control" name="name" value="{{ $taxonomy->name ?? ''}}" required>
                        @error('name')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('input_field_type') ? 'has-error' : ''}}">
                        <label for="input_type">Input Field Type <span class="text-danger">*</span></label>
                        <select id="input_type" class="form-control custom-select" name="input_field_type">
                          <option selected disabled>Select one</option>
                          <option value="Text" @if($taxonomy->input_field_type == 'Text') selected @endif>Text</option>
                          <option value="Textarea" @if($taxonomy->input_field_type == 'Textarea') selected @endif>Textarea</option>
                          <option value="Date" @if($taxonomy->input_field_type == 'Date') selected @endif>Date</option>
                          <option value="Number" @if($taxonomy->input_field_type == 'Number') selected @endif>Number</option>
                          <option value="Select" @if($taxonomy->input_field_type == 'Select') selected @endif>Select</option>
                        </select>
                        @error('input_field_type')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div id="input_req" class="form-group {{ $errors->has('input_required') ? 'has-error' : ''}}">
                      <input type="hidden" name="input_required" value="0">
                      <label for="inputName" data-labelfor="input_required" class="my-4"><input type="checkbox" name="input_required" value="{{ $taxonomy->input_required ?? '1'}}" class="mx-2" {{ $taxonomy->input_required ? 'checked' : '' }} > Input Field Required</label>
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
                        <input type="number" id="inputOrder" class="form-control" name="order_no" value="{{ $taxonomy->order_no ?? ''}}" required>
                        @error('order_no')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                      <label for="inputStatus">Status  <span class="text-danger">*</span></label>
                      <select id="inputStatus" class="form-control custom-select" name="status">
                        <option selected disabled>Select one</option>
                        <option value="1" @if($taxonomy->status == '1') selected @endif>Active</option>
                        <option value="2" @if($taxonomy->status == '2') selected @endif>Deactive</option>
                      </select>
                      @error('status')
                        <span class="invalid-feedback" role="alert" style="display:block;">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Update Custom Field" class="btn btn-success float-right">
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