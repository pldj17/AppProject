@if (session("error"))
    <div class="alert alert-danger alert-dismissible" data-auto-dismiss="2000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Error!</h5>
        {{ session("error") }}
    </div>
@endif
