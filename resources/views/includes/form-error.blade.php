@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-exclamation-triangle"></i></span>
        <span class="alert-inner--text"><strong>  &nbsp;&nbsp;Alerta!</strong>!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
@endif
