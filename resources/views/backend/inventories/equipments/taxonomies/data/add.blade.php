@extends('backend.layout.master')
@section('pagetitle', 'Taxonomy Data Add')

@section('head')

@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add Taxonomy Data <a href="{{ route('taxonomy.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Taxonomy Data Add</li>
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
              <h3 class="card-title">Add Taxonomy Data Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('taxonomyData.store', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                          <label for="inputName">Name <span class="text-danger">*</span></label>
                          <input type="text" id="inputName" class="form-control" name="name" required value="{{ old('name') }}">
                          @error('name')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    </div>    
                    <div class="col-md-6">
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
          <input type="submit" value="Create new taxonomy data" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')

@endsection