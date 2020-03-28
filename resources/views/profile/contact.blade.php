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
                        <a class="nav-link active" href="{{route('perfil_contact', ['id' => $user->id])}}">
                            Contactos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rating', ['id' => $user->id])}}">
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

                            <strong><i class="fas fa-phone-alt mr-1"></i> Teléfono</strong><br>
                    
                            @if (empty($perfil->phone) && (Auth::user()->id == $user->id))
                            <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="phone" style="text-decoration:none;"><small>Agregar teléfono</small></a>
                            @else
                            <small class="text-muted">{{$perfil->phone}}</small>
                            @endif
                        
                            <hr>
                    
                            <strong><i class="fas fa-envelope mr-1"></i> Correo electrónico</strong><br>
                    
                            @if (empty($perfil->correo) && (Auth::user()->id == $user->id))
                            <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Correo electrónico</small></a>
                            @else
                            <small class="text-muted">{{$perfil->correo}}</small>
                            @endif
                    
                            <hr>
                            
                            {{-- <strong><i class="fab fa-whatsapp"></i> Whatsaap</strong><br>
                    
                            @if (empty($perfil->description) && (Auth::user()->id == $user->id))
                            <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Descripción</small></a>
                            @else
                            <small class="text-muted">{{$perfil->description}}</small>
                            @endif --}}
                        </div>

                    </div>
                </div>
            </div>
            @if(empty($perfil->facebook) && empty($perfil->whatsapp))
            @else
            <div class="card" style="background-color:#343a40;">
                <div class="card-body">
                    
                    <ul id="networks">
                        <li>
                            <strong style="color: white;">Redes Sociales:</strong><br>
                        </li>
                        @if($perfil->facebook != null)
                        <li>
                            <a href="{{$perfil->facebook}}" target="_blank">
                                <img src="{{asset('assets/profile/img/facebook.png') }}">
                            </a>
                        </li>
                        @endif
                        @if($perfil->whatsapp != null)
                            <li>
                                <a href="{{$perfil->whatsapp}}" target="_blank">
                                    <img src="{{asset('assets/profile/img/whatsapp.png') }}">
                                </a>
                            </li>
                        @endif
                        {{-- <li>
                            <a href="https://www.instagram.com/pldj01/?hl=es-la" target="_blank">
                                <img src="{{asset('assets/profile/img/instagram.png') }}">
                            </a>
                        </li>  --}}
                    </ul>
                
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection