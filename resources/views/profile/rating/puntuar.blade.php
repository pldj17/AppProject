@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section("styles")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/profile/css/edit.css') }}">
@endsection

@section('scripts')

@endsection

@section('title')
    <h2>Mi perfil</h2>
@endsection

@section('contenido')

<div class="container-fluid">
    @include('includes.form-error')
    @include('includes.mensaje')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            @include('profile.ProfileImage')

            <!-- About Me Box -->
            @if (($perfil->private == 1))
            @include('profile.about_me')
            @endif
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
            @if (($perfil->private == 1))
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('perfil',  ['id' => $user->id])}}">
                            Actividades
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route("perfil_post", ['id' => $user->id])}}">
                                Fotos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('perfil_contact', ['id' => $user->id])}}">
                                Contactos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('rating', ['id' => $user->id])}}">
                                Calificar
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                    <a class="nav-link " href="{{route('perfil',  ['id' => $user->id])}}">
                        Mi información
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Favoritos
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">
                        <i class="far fa-question-circle"  style="margin-top:40%" data-toggle="tooltip" data-placement="bottom" title="Acerca de..."></i>
                    </a>
                    </li>
                    {{-- <li class="nav-item" >
                        <a class="nav-link" href="#settings" data-toggle="tab"  style="float:right;">
                        <i class="far fa-question-circle"  style="margin-top:40%" data-toggle="tooltip" data-placement="bottom" title="Acerca de..."></i>
                        </a>
                    </li> --}}
                </ul>
                </div>
            @endif
                <div class="card-body">
                    <div class="tab-content">

                        <div class="card-body">
                            <div class="row">
                                <a href="#"></a>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                    Calificar Servicio
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Calificar servicios</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Elige una clasificación por estrellas&hellip;</h5><br>
          <div class="row justify-content-center">
            <ul class="list-inline">
                <li class="list-inline-item" name="" value="1"><i class="fas fa-star fa-2x"></i></li>
                <li class="list-inline-item" name="" value="2"><i class="fas fa-star fa-2x"></i></li>
                <li class="list-inline-item" name="" value="3"><i class="fas fa-star fa-2x"></i></li>
                <li class="list-inline-item" name="" value="4"><i class="fas fa-star fa-2x"></i></li>
                <li class="list-inline-item" name="" value="5"><i class="fas fa-star fa-2x"></i></li>
            </ul>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </div>
</div>
@endsection

