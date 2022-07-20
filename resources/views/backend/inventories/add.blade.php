@extends('backend.layout.master')
@section('pagetitle', 'Customer Add')

@section('head')

@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add Customer <a href="{{ route('inventory.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer Add</li>
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
              <h3 class="card-title">Add Customer Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="inputName">Name <span class="text-danger">*</span></label>
                          <input type="text" id="inputName" class="form-control" name="name" required>
                      </div>
                       <div class="form-group">
                          <label for="inputStatus">Status <span class="text-danger">*</span></label>
                          <select id="inputStatus" class="form-control custom-select" name="status">
                          <option selected disabled>Select one</option>
                          <option value="1">Active</option>
                          <option value="2">Deactive</option>
                      </select>
                      </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPhone">Phone <span class="text-danger">*</span></label>
                            <input type="tel" id="inputPhone" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="inputCPassword">Address <span class="text-danger">*</span></label>
                            <textarea id="inputAddress" class="form-control" rows="3" name="address" required></textarea>
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
          <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new customer" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
@endsection