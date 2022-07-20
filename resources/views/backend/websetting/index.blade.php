@extends('backend.layout.master')
@section('pagetitle', 'Web Setting')

@section('head')

@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Web Setting <a href="{{ route('dashboard') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Web Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
          {{ session('status') }}
        </div>
        @endif
          <div class="card card-primary">
            <div class="card-body">
      
                <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data->id ?? ''}}" required>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">Website Title <span class="text-danger">*</span></label>
                        </div>
                    </div>
                     <div class="col-md-6 col-sm-offset-2">
                        <div class="form-group">
                          <input type="text" id="inputName" class="form-control" name="sitename" value="{{$header['sitename'] ?? ''}}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">Logo <span class="text-danger">*</span></label>
                        </div>
                    </div>
                     <div class="col-md-6 col-sm-offset-2">
                        @if($header['logoimage'])
                        <div class="form-group">
                          <img class="image" src="{{asset($header['logoimage'])}}" alt="logoimage" style="width: 40%; padding: 10px; margin: 0px; ">
                        </div>
                        @endif
                        <div class="form-group">
                          <input type="file" name="logoimage" placeholder="Choose image" id="image">
                          @error('image')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">Favicon <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-offset-2">
                        @if($header['faviconimage'])
                        <div class="form-group">
                          <img class="image rounded-circle" src="{{asset($header['faviconimage'])}}" alt="faviconimage" style="width: 8%;padding: 10px; margin: 0px; ">
                        </div>
                        @endif
                        <div class="form-group">
                          <input type="file" name="faviconimage" placeholder="Choose image" id="image">
                          @error('image')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">Topbar & Sidebar Color  <span class="text-danger">*</span></label>
                        </div>
                    </div>
                     <div class="col-md-6 col-sm-offset-2">
                        <div class="form-group">
                          <select id="inputtsclr" class="form-control custom-select" name="tsclr">
                            <option selected disabled>Select one</option>
                            <option value="1" @if($header['tsclr'] == '1') selected @endif>Dark</option>
                            <option value="2" @if($header['tsclr'] == '2') selected @endif>Light</option>
                        </select>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">CopyRight <span class="text-danger">*</span></label>
                        </div>
                    </div>
                     <div class="col-md-6 col-sm-offset-2">
                        <div class="form-group">
                          <input type="text" id="inputCopyright" class="form-control" name="copyright" value="{{$header['copyright'] ?? ''}}" required>
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
        <div class="col-12 mb-5">
          <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')

@endsection