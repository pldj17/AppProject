@if (session("mensaje"))
    <div class="alert alert-success alert-dismissible" data-auto-dismiss="1000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Mensaje!</h5>
        {{ session("mensaje") }}
    </div>

    {{-- <div class="alert alert-success alert-dismissible" role="alert" data-auto-dismiss="2000">
        <span class="alert-inner--icon"><i class="fas fa-check"></i></span>
        <span class="alert-inner--text"><strong> &nbsp;&nbsp;Mensaje</strong>!</span>
        <button type="button" class="btn btn-success swalDefaultSuccess data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li>{{ session("mensaje") }}</li>
        </ul>
    </div> --}}
@endif
