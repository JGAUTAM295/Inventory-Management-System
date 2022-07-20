@extends('backend.layout.master')
@section('pagetitle', 'Work Order Add')

@section('head')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Add Work Order <a href="{{ route('work_order.index') }}"><button class="btn btn-primary">Back</button></a></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Work Order Add</li>
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
              <h3 class="card-title">Add Work Order Details</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('work_order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('equipmentissue_id') ? 'has-error' : ''}}">
                          <label for="inputName">Name/ Equipment Issue <span class="text-danger">*</span></label>
                          <!--<input type="text" id="inputName" class="form-control" name="name" required value="{{ old('name') }}">-->
                          <select id="inputEquipmentIssue" class="form-control" name="equipment_id" required>
                            <option selected disabled>Select one</option>
                            @foreach($equipment_issues as $equipment_issue)
                            <option value="{{$equipment_issue->id}}">{{ucwords($equipment_issue->equipment->title) ?? ''}}</option>
                            @endforeach
                          </select>
                          @error('equipmentissue_id')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                      
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="inputDescription">Description <span class="text-danger">*</span></label>
                        <textarea id="inputDescription" class="form-control" rows="8" name="description" required></textarea>
                        @error('description')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      
                      <div class="form-group {{ $errors->has('scope_of_work') ? 'has-error' : ''}}">
                        <label for="inputDescription">Scope Of Work <span class="text-danger">*</span></label>
                        <textarea id="inputDescription" class="form-control" rows="9" name="scope_of_work" required></textarea>
                        @error('scope_of_work')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>    
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('staff_id') ? 'has-error' : ''}}">
                          <label for="inputStaff">Contact Person <span class="text-danger">*</span></label>
                          <select id="inputStaff" class="form-control" name="staff_id" required>
                            <option selected disabled>Select one</option>
                            @foreach($staffs as $val)
                            <option value="{{$val->id ?? ''}}">{{ucwords($val->name) ?? ''}}</option>
                            @endforeach
                          </select>
                          @error('staff_id')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div class="form-group {{ $errors->has('client_id') ? 'has-error' : ''}}">
                          <label for="inputClient">Client <span class="text-danger">*</span></label>
                          <select id="inputClient" class="form-control" name="client_id" required>
                            <option selected disabled>Select one</option>
                            @foreach($inventories as $val)
                            <option value="{{$val->id ?? ''}}">{{ucwords($val->name) ?? ''}}</option>
                            @endforeach
                          </select>
                          @error('client_id')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $client_id }}</strong>
                          </span>
                          @enderror
                      </div>
                      
                      <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                        <label for="inputAddress">Address <span class="text-danger">*</span></label>
                        <textarea id="inputAddress" class="form-control" rows="2" name="address" readonly></textarea>
                        @error('address')
                          <span class="invalid-feedback" role="alert" style="display:block;">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>

                      <div class="form-group {{ $errors->has('orderdate') ? 'has-error' : ''}}">
                        <label for="inputOrderdate">Work Order Date <span class="text-danger">*</span></label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" id="inputOrderdate" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="orderdate" value="{{ date('d-m-Y h:i:s') }}" required/>
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                      </div>
                      
                      <div class="form-group {{ $errors->has('department_no') ? 'has-error' : ''}}">
                        <label for="inputStatus">Department <span class="text-danger">*</span></label>
                        <select id="inputStatus" class="form-control custom-select" name="department_no">
                          <option selected disabled>Select one</option>
                          @foreach($departments as $department)
                          <option value="{{$department->department_no ?? ''}}">{{$department->name ?? ''}}</option>
                          @endforeach
                        </select>
                      @error('department_no')
                        <span class="invalid-feedback" role="alert" style="display:block;">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                      
                      <div class="form-group {{ $errors->has('priority') ? 'has-error' : ''}}">
                        <label for="inputPriority">Priority <span class="text-danger">*</span></label>
                        <select id="inputPriority" class="form-control custom-select" name="priority">
                          <option selected disabled>Select one</option>
                          <option value="highest">Highest</option>
                          <option value="high">High</option>
                          <option value="medium">Medium</option>
                          <option value="low">Low</option>
                          <option value="lowest">Lowest</option>
                        </select>
                      @error('priority')
                        <span class="invalid-feedback" role="alert" style="display:block;">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                      
                      <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                        <label for="inputStatus">Status <span class="text-danger">*</span></label>
                        <select id="inputStatus" class="form-control custom-select" name="status">
                          <option selected disabled>Select one</option>
                          <option value="1">Cancelled</option>
                          <option value="2">Started</option>
                          <option value="3">Pending</option>
                          <option value="4">Processing</option>
                          <option value="5">Complete</option>
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
          <a href="{{ route('work_order.index') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new work order" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
 
@endsection

@section('footerscript')
<!-- date-range-picker -->
<script src="{{ URL::asset('assests/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
      //DateTime picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
      
         //GET CLIENT ADDRESS BY CLIENT ID FROM Inventory TABLE
        $('#inputClient').change(function()
        {
            
            $.ajax({
                type: "POST",
                url: '{{route("user.fetchInventory")}}',
                data: {id:$(this).val()},
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(response)
                {
                    console.log(response);
                    if(response.status == '200')
                    {
                        if(response.data != '')
                        {
                            $("#inputAddress").val(response.data);
                        }
                        else
                        {
                            $("#inputAddress").val('');
                        }
                        
                    }
                    else
                    {
                        $("#inputAddress").val('');
                    }
                }
            });
        });
    });
</script>
@endsection