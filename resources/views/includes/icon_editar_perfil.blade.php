@if (Auth::user()->id == $user->id)
    <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="float-right btn-tool" style="position:absolute;">
        <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar perfil"></i>
    </a>
@endif