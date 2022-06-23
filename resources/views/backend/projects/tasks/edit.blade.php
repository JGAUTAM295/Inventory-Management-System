@extends('backend.layout.master')
@section('pagetitle', 'Task Edit')

@section('head')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Task Detail <a href="{{ route('tasks', ['id' => $task->project_id]) }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Task Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mb-4">
      <div class="row">
        <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
          {{ session('status') }}
        </div>
        @endif
        </div>
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit {{ ucwords($task->title) ?? ''}} Task Details</h3>
            </div>
            <div class="card-body">
            <form action="{{ route('updateTask', ['id' => $task->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $task->id ?? ''}}">
              <input type="hidden" name="project_id" value="{{$task->project_id ?? ''}}">
              <div class="form-group">
                <label for="inputName">Task Name</label>
                <input type="text" id="inputName" class="form-control" name="title" value="{{$task->title ?? ''}}">
              </div>
              <div class="form-group">
                <label for="inputDescription">Task Description</label>
                <textarea id="inputDescription" class="form-control" rows="4" name="description">{{$task->description ?? ''}}</textarea>
              </div>
              <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select id="inputStatus" class="form-control custom-select" name="status">
                      <option selected disabled>Select one</option>
                      <option value="1" @if($task->status == 'On Hold') selected @endif>On Hold</option>
                      <option value="2" @if($task->status == 'Canceled') selected @endif>Canceled</option>
                      <option value="3" @if($task->status == 'Start') selected @endif>Start</option>
                      <option value="4" @if($task->status == 'Working') selected @endif>Working</option>
                      <option value="5" @if($task->status == 'Success') selected @endif>Success</option>
                  </select>
              </div>

                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Update" class="btn btn-success float-right">
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')

@endsection