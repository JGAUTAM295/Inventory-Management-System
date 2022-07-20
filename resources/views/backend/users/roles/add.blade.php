@extends('backend.layout.master')
@section('pagetitle', 'UserRole Add')

@section('head')

@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add UserRole <a href="{{ route('roles.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">UserRole Add</li>
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
              <h3 class="card-title">Add UserRole Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputName">Name  <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputProjectLeader">Permission <span class="text-danger">*</span></label>
                        <table class="table table-striped">
                        <thead>
                          <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                          <th scope="col" width="20%">Name</th>
                          <th scope="col" width="1%">Guard</th>
                        </thead>
                        @foreach($permissions as $value)
                        <tr>
                            <td>
                                <input type="checkbox" name="permission[]" value="{{ $value->id }}" class='permission'>
                            </td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->guard_name }}</td>
                        </tr>
                        @endforeach
                      </table>
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
          <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new userrole" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<script type="text/javascript">
    $(document).ready(function() {
        $('[name="all_permission"]').on('click', function() {

            if($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked',true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked',false);
                });
            }
            
        });
    });
</script>
@endsection