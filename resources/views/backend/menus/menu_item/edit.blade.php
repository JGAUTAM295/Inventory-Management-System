@extends('backend.layout.master')
@section('pagetitle', 'Menu Item Edit')

@section('head')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Menu Item Detail <a href="{{ route('menus_item.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Menu Item Edit</li>
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
              <h3 class="card-title">Edit {{ ucwords($menu_item->name) ?? ''}} Menu Item Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('menus_item.update', $menu_item->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                  @csrf
                <input type="hidden" name="id" value="{{$menu_item->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Name <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="name" value="{{$menu_item->name ?? ''}}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">URL <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="url" value="{{$menu_item->url ?? ''}}" required>
                            @if ($errors->has('faicon'))
                            <span class="text-danger text-left">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Menu Order <span class="text-danger">*</span></label>
                            <input type="number" id="inputMenuorder" class="form-control" name="menu_order" value="{{$menu_item->menu_order ?? ''}}" required>
                            @if ($errors->has('menu_order'))
                            <span class="text-danger text-left">{{ $errors->first('menu_order') }}</span>
                            @endif
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
          <a href="{{ route('menus_item.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Update menu item" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')

@endsection