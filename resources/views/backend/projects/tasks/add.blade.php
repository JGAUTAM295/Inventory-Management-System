@extends('backend.layout.master')
@section('pagetitle', 'Task Add')

@section('head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ URL::asset('css/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
            <h3>Add Task <a href="{{ route('projects') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Task Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Task Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('storeTask') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project_id" value="{{$id ?? ''}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputName">Task Name  <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="title" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputDescription">Task Description  <span class="text-danger">*</span></label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select id="inputStatus" class="form-control custom-select" name="status">
                                <option selected disabled>Select one</option>
                                <option value="1">On Hold</option>
                                <option value="2">Canceled</option>
                                <option value="3">Start</option>
                                <option value="4">Working</option>
                                <option value="5">Success</option>
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
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new task" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')

@endsection