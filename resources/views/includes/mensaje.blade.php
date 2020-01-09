@if (session("mensaje"))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-auto-dismiss="3000">
        <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
        <span class="alert-inner--text"><strong> &nbsp;&nbsp;Mensaje!</strong>!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li>{{ session("mensaje") }}</li>
        </ul>
    </div>
@endif
