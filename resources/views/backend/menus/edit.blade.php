@extends('backend.layout.master')
@section('pagetitle', 'Menu Edit')
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
@section('head')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Menu Detail <a href="{{ route('menus.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Menu Edit</li>
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
              <h3 class="card-title">Edit {{ ucwords($menus->name) ?? ''}} Menu Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('menus.update', $menus->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                  @csrf
                  <input type="hidden" name="id" value="{{$menus->id}}">
                 <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Userole <span class="text-danger">*</span></label>
                            <select id="roles" name="roles[]" id="inputRoles" class="form-control select2" multiple="multiple" data-placeholder="Select one" style="width: 100%;">
                                @foreach($roles as $role)
                                    <option value="{{$role}}" {{ (in_array($role, $selected_role)) ? 'selected' : '' }}>{{$role}}</option>
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
                            <input type="text" id="inputName" class="form-control" name="name" value="{{ $menus->menu_item ?? '' }}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Fa-icon Class <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="faicon" value="{{ $menus->faicon ?? '' }}">
                            @if ($errors->has('faicon'))
                            <span class="text-danger text-left">{{ $errors->first('faicon') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">URL <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" class="form-control" name="url" value="{{ $menus->url ?? '' }}" required>
                            @if ($errors->has('faicon'))
                            <span class="text-danger text-left">{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputName">Child Menu <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input class="parentmenu mx-2" type="radio" name="parentmenu" value="Yes" @if($menus->child_menu == 'Yes') checked @endif/> Yes
                                <input class="parentmenu mx-2" type="radio" name="parentmenu" value="No" @if($menus->child_menu == 'No') checked @endif/> No
                            </div>
                            <div id="parentmenuYes" class="form-group" @if($menus->child_menu == 'Yes') style="display:block;" @else style="display:none;" @endif>
                                <select id="parent_id" name="parent_id[]" id="inputParentid" class="form-control select2" multiple="multiple" data-placeholder="Select one" style="width: 100%;">
                                    @foreach($menu_items as $menu_item)
                                    <option value="{{$menu_item->id}}" {{ (in_array($menu_item->id, $selected_menu)) ? 'selected' : '' }}>{{$menu_item->name}}</option>
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
                            <input type="number" id="inputMenuorder" class="form-control" name="menu_order" value="{{ $menus->menu_order ?? '' }}" required>
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
                                <option value="1" @if($menus->status == '1') selected @endif>Active</option>
                                <option value="2" @if($menus->status == '2') selected @endif>Deactive</option>
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
          <input type="submit" value="Update menu" class="btn btn-success float-right">
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