@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section("styles")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/profile/css/edit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css') }}">
@endsection

@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> --}}
    <script>var url = "{{ route('new_rating', [$perfil->id]) }}";</script>
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
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group" style="margin-left:10%;">
                        <p style="text-aling:center;">
                            <strong>Calificaciones</strong>
                        </p><br>
                        <h1 style="font-size:500%; margin-right:50%;">{{bcdiv($avgStar, '1', 1)}}</h1>
                        @include('profile.rating.rating')
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                            @if(empty($comment) && $perfil->user_id != auth()->user()->id)
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                    Puntuar servicios
                                    {{ $perfil->user_id}}{{auth()->user()->id}}
                                </button>
                            @endif
                      </div>
                    </div>
                </div>
            </div>
            <div>
                @foreach($RatingStar as $r)
                    @if($r->profile_id == $perfil->id)
                        <div class="container" style="margin-left:35px;">
                            <h5>Tu puntuación</h5>
                        </div>
                        {{-- {{$r->id}} --}}
                        <div class="card-footer card-comments">
                            <div class="card-comment">
                                @if (empty(auth()->user()->profile->avatar))
                                    <img class="img-circle img-sm" src="{{ asset('avatar/avatar.png')}}" alt="User Image">
                                @else
                                    <img class="img-circle img-sm" src="{{ asset('uploads/profile_pictures')}}/{{ auth()->user()->profile->avatar }}" alt="User Image">
                                @endif
                            <div class="comment-text">
                                <small class="username">
                                    {{auth()->user()->name}}
                                </small>
                                <small>
                                    <span class="text-muted float-right">{{$r->created_at->diffForHumans()}}</span><br>
                                    {{-- <span class="text-muted float-right">
                                        <a href="{{route('editar_rating', [$r->id])}}" class="btn-accion-tabla" data-toggle="tooltip" data-placement="bottom" title="Editar puntuación">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </span> --}}
                                </small>
                                {{-- <br> --}}
                                <small>
                                <span class="text-muted float-right">
                                    <form action="{{route('eliminar_rating', ['id' => $r->id])}}" class="d-inline" method="POST">
                                        @csrf @method("delete")
                                        <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar puntuación">
                                            <i class="fa fa-fw fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </span>
                                </small>
                               
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 1 ? ' blue' : ''}}"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 2 ? ' blue' : ''}}"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 3 ? ' blue' : ''}}"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 4 ? ' blue' : ''}}"></i></li>
                                    <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 5 ? ' blue' : ''}}"></i></li>
                                </ul>
                                <b>{{$r->title_rating}}</b><br>
                                {{$r->description_rating}}
                            </div>
                            </div>
                        </div>
                    @endif
                @endforeach
               
                @foreach($R as $r)
                    @if($r->profile_id == $perfil->id && $r->user_id != auth()->user()->id)
                    @if($countRatings >= 1 )
                        @if($loop->first)
                            <div class="container" style="margin-top:10px; height:13px; margin-left:35px;">
                                <h5>Puntuaciones</h5>
                            </div>
                        @endif
                    @endif
                        <br>
                        @foreach($usuarios as $u)
                            @if($u->id == $r->user_id)
                                <div class="card-footer card-comments" style="background-color:white;">
                                    <div class="card-comment">
                                        @if (empty($u->avatar))
                                            <img class="img-circle img-sm" src="{{ asset('avatar/avatar.png')}}" alt="User Image">
                                        @else
                                            <img class="img-circle img-sm" src="{{ asset('uploads/profile_pictures')}}/{{$u->avatar }}" alt="User Image">
                                        @endif
                                    <div class="comment-text">
                                        <small class="username">
                                            {{$u->user->name}}
                                        </small>
                                        <small>
                                            <span class="text-muted float-right">{{$r->created_at->diffForHumans()}}</span>
                                        </small>
                                        
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 1 ? ' blue' : ''}}"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 2 ? ' blue' : ''}}"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 3 ? ' blue' : ''}}"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 4 ? ' blue' : ''}}"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->rating >= 5 ? ' blue' : ''}}"></i></li>
                                        </ul>
                                        <b>{{$r->title_rating}}</b><br>
                                        {{$r->description_rating}}
                                    </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div>


{{-- modal --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Elige una clasificación por estrellas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('new_rating', [$perfil->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="margin-top:15px;">
                        <div class="row justify-content-center " >

                            <div class="container star rating" style="margin-left:10%;">
                                <input name="rating" value="5" type="radio" class="star" id="star-1"/> <label for="star-1" data-dataid="1" required></label>  
                                <input name="rating" value="4" type="radio" class="star" id="star-2"/> <label for="star-2" data-dataid="2" required></label>  
                                <input name="rating" value="3" type="radio" class="star" id="star-3"/> <label for="star-3" data-dataid="3" required></label>  
                                <input name="rating" value="2" type="radio" class="star" id="star-4"/> <label for="star-4" data-dataid="4" required></label>  
                                <input name="rating" value="1" type="radio" class="star" id="star-5"/> <label for="star-5" data-dataid="5" required></label> 
                                {{-- {{$perfil->id}} --}}
                            </div>
                                <input type="hidden" name="profile_id" value="{{ $perfil->id }}">
                            
                        </div>
                    </div> <br><br>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="title" name="title_rating" class="form-control" id="title" placeholder="Pon título a tu opinión">
                        </div>
                        <div class="form-group">
                            <textarea type="description" name="description_rating" class="form-control" id="description" placeholder="Dinos que tal te ha parecido"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="submitRatingStar" id="submitRatingStar" class="btn btn-primary btn-sm">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- fin modal --}}

@endsection

