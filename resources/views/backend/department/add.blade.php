@extends('backend.layout.master')
@section('pagetitle', 'Department Add')

@section('head')
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add Department <a href="{{ route('departments.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Department Add</li>
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
              <h3 class="card-title">Add Department Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('department_no') ? 'has-error' : ''}}">
                            <label for="inputDepartmentNumber">Department Number <span class="text-danger">*</span></label>
                            <input type="number" id="inputDepartmentNumber" class="form-control" name="department_no" required>
                            @error('department_no')
                            <span class="invalid-feedback" role="alert" style="display:block;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->has('colorbg') ? 'has-error' : ''}}">
                            <label for="inputCPassword">Color <span class="text-danger">*</span></label>
                            <div class="input-group my-colorpicker2">
                                <input type="text" class="form-control" name="colorbg" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                            </div>
                            @error('colorbg')
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
          <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new department" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- bootstrap color picker -->
<script src="{{ URL::asset('assests/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script>
    //color picker with addon
    $('.my-colorpicker2').colorpicker();

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
</script>
@endsection