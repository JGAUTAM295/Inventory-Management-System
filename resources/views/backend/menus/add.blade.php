@extends('backend.layout.master')
@section('pagetitle', 'Menu Add')

@section('head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
            <h3>Add Menu <a href="{{ route('menus.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Menu Add</li>
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
              <h3 class="card-title">Add Menu Item</h3>
            </div>
            <div class="card-body">
           
                <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Userole <span class="text-danger">*</span></label>
                            <select id="roles" name="roles[]" id="inputRoles" class="form-control select2" multiple="multiple" data-placeholder="Select one" style="width: 100%;">
                                @foreach($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('roles'))
                            <span class="text-danger text-left">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Name <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Fa-icon Class <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="faicon" value="{{ old('faicon') }}">
                            @if ($errors->has('faicon'))
                            <span class="text-danger text-left">{{ $errors->first('faicon') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">URL <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="url" value="{{ old('url') }}" required>
                            @if ($errors->has('faicon'))
                            <span class="text-danger text-left">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Child Menu <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input class="parentmenu mx-2" type="radio" name="parentmenu" value="Yes" /> Yes
                                <input class="parentmenu mx-2" type="radio" name="parentmenu" value="No" /> No
                            </div>
                            <div id="parentmenuYes" class="form-group" style="display:none;">
                                <select id="parent_id" name="parent_id[]" id="inputParentid" class="form-control select2" multiple="multiple" data-placeholder="Select one" style="width: 100%;">
                                    @foreach($menu_items as $menu_item)
                                    <option value="{{$menu_item->id}}">{{$menu_item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('parent_menu'))
                            <span class="text-danger text-left">{{ $errors->first('parent_menu') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Menu Order <span class="text-danger">*</span></label>
                            <input type="number" id="inputMenuorder" class="form-control" name="menu_order" value="{{ old('menu_order') }}" required>
                            @if ($errors->has('menu_order'))
                            <span class="text-danger text-left">{{ $errors->first('menu_order') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputStatus">Status <span class="text-danger">*</span></label>
                            <select id="inputStatus" class="form-control custom-select" name="status">
                                <option selected disabled>Select one</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
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
          <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save menu item" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- Select2 -->
<script src="{{ URL::asset('assests/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
//Initialize Select2 Elements
    $('.select2').select2();
    
    $('.parentmenu').change(function(){
        if($(this).val() == 'Yes')
        {
            $('#parentmenu' + $(this).val()).show();
        }
        else
        {
            $('#parentmenuYes').hide();
        }
    });
</script>
@endsection