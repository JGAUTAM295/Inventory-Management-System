@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif 
@else
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-check"></i>
                {{ $error }}
            </div>
        @endforeach
    
@endif