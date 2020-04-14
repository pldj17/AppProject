@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    {{-- <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script> --}}

    <script src="{{ asset ('assets/profile/js/perfil.js') }}"></script>
    <script src="{{ asset ('assets/profile/js/comentarios.js') }}"></script>
    <script src="{{ asset ('assets/photo/js.js') }}"></script>
    <script src="{{asset("assets/js/galeria.js")}}"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/galeria.css') }}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/photo/fotoPerfil.css') }}">
@endsection


@section('title')
  <h2>Mi perfil</h2>
@endsection

@section('contenido')  

    <div class="container-fluid">
      @include('includes.form-error')
      @include('includes.mensaje')
      @include('includes.mensaje_error')
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          @include('profile.ProfileImage')

          <!-- About Me Box -->
          @if ($perfil->private == 1 )
            @include('profile.about_me')
          @endif
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            @if ($perfil->private == 1 )
              @include('includes.tabs')
            @else
              @include('includes.tabsPrivate')
            @endif
            <div class="card-body">
              <div class="tab-content">

              @if($perfil->private == 1 )

                @if (Auth::user()->id == $user->id)
                    @if($perfil->address_address == null && $perfil->description == null && empty(implode(', ',$perfil->especialidades()->get()->pluck('name')->toArray())))
                      <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Alert!</h5>
                        Complete el formulario de informaciones para que su perfil este visible en el inicio. 
                        <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" style="text-decoration:none; color:blue;">Agregar información</a>
                      </div>
                    @endif

                  <div class="active tab-pane" id="activity">

                  <!-- Post -->
                    <div >
                      <div class="container">
                          <form action="{{ route('guardar_post', [$user->id]) }}" class="form-image-upload" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="col-md-12">
                                    <strong>Crear publicación:</strong><br><br>
                                    @if($posts < 1)
                                      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Crear mi primera publicación"></textarea>
                                    @else
                                      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Descripción"></textarea>
                                    @endif
                                </div>  
                            </div>
                            
                            <div class="col-md-5 mr--1">
                              <input type="file" class="custom-file-input" name="file[]" id="file" accept="image/*" multiple />
                              
                                <label class="custom-file-label" for="customFile"><i class="far fa-images"></i></label> 
                                
                            </div>
                            <div class="col-md-2">
                                <br/>
                                <button type="submit"  name="upload" value="Upload" class="btn btn-primary">Publicar</button>
                            </div>
                          </form>
                        
                      </div>
                    </div>
                  </div>
                  <hr>
                @endif

            </div><!-- /.card-body -->


            <div class="card-body" id="tabla-data">
              @foreach ($post as $imgCollection)
                
                    <div class="active tab-pane" id="activity">
                      <div class="post">
                        <div class="user-block">
                          @if (empty($perfil->avatar))
                              <img src="{{ asset('avatar/avatar.png')}}" class="img-circle img-bordered-sm">
                          @else
                              <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}"  class="img-circle img-bordered-sm">  
                          @endif
                          <span class="username">
                            <a href="#">{{$user->name}}</a>
                            @if (Auth::user()->id == $user->id)  
                              <div class="btn-group" style="float:right;">
                                  <button type="button" class="btn btn-tool" data-toggle="dropdown" style="display:">
                                    <i class="fas fa-ellipsis-v"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right" id="tabla-data" role="menu">
                                    
                                    @foreach ($imgCollection as $post)

                                      <form action="{{route('eliminar_post', ['id' => $imgCollection->id])}}" class="d-inline form-eliminar" method="POST"   >
                                        <input type="hidden" name="_method" value="delete">
                                        @csrf 
                                        <button type="submit"  class="btn-accion-tabla eliminar" style="margin-left:20px;" >
                                          <i class="fa fa-trash text-danger"></i>&nbsp; Eliminar
                                        </button>
                                      </form>
                                      @if ($loop->first)
                                          @break
                                      @endif
                                    @endforeach
                                  </div>
                                </div>
                              @endif
                          </span>

                          @foreach ($imgCollection as $post)
                            @if ($loop->first)
                            <span class="description" title="{{ $imgCollection->created_at->format('d-m-Y H:i') }}">{{$imgCollection->created_at->diffForHumans()}}&nbsp;<i class="far fa-clock"></i> </span>
                          
                        </div>
                            <p>
                              {{$imgCollection->description}}
                            </p>
                            
                            @endif
                          @endforeach

                        
                        <div class="row" style="margin-top:10px;" id="tabla-data">

                            @foreach ($imgCollection->photos as $a)
                              @if(empty($a->file))

                              @else
                              <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                                <a href="/images/{{ $a->file }}" class="fancybox" rel="ligthbox" style="width:100%; height:70%">
                                  <img src="/images/{{ $a->file }}" class="zoom img-fluid" alt="" style="width:100%; height:100%">
                                </a>   
                              </div>
                              @endif
                            @endforeach
                        
                        </div>
                        
                        @if($comments->where('post_id', $imgCollection->id)->count() == 0)
                        
                        @else
                        <p>
                          <span class="float-right">
                            <a href="{{ route('mostrar_comentarios', [$user->id, $imgCollection->id] ) }}" class="link-black text-sm" style="text-decoration:none;">
                              <i class="far fa-comments mr-1"></i> Comentarios ({{ $comments->where('post_id', $imgCollection->id)->count() }})
                            </a>
                          </span>
                        </p>
                        @endif
                        <br>

                        {{-- comentarios --}}
                        @foreach ($imgCollection as $post)
                          @if ($loop->first)
                            <form class="form-horizontal" action="{{ route('guardar_comentario', [$user->id, $perfil->id]) }}" method="POST" autocomplete="off">
                              @csrf 
                              <input type="hidden" name="post_id" value="{{ $imgCollection->id }}">
                              <input type="hidden" name="token_perfil" value="{{$perfil->user->device_token}}">
                              <input type="hidden" name="perfil_post_id" value="{{$imgCollection->user_id}}">
                              <div class="input-group input-group-sm mb-0">
                                <input class="form-control form-control-sm" name="message" placeholder="Agregar comentario...">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                              </div>
                            </form>
                          @endif
                        @endforeach

                        <br><br>
                        
                        @foreach ($comments as  $comment)
                          @if($comment->post_id == $imgCollection->id  && $comment->user->active == 1)
                          @if($loop->last)
                            {{-- @if($comments->where('post_id', $imgCollection->id)->count() > 0 && $comments->where('post_id', $imgCollection->id)->count() <=2) --}}
                              <div class="direct-chat-infos clearfix" id="comentario">
                                <div class="user-block" style="margin-top:-4%;">
                                    @if (empty($comment->user->profile->avatar))
                                      <img class="img-circle img-bordered-sm" src="{{ asset('avatar/avatar.png')}}" alt="user image" style="height:35px; width:35px;">
                                    @else
                                      <img class="img-circle img-bordered-sm" src="{{ asset('uploads/profile_pictures')}}/{{ $comment->user->profile->avatar }}" alt="user image" style="height:35px; width:35px;">
                                    @endif  
                                  <span class="username" id="comentario">
                                    <a style="color:#007bff; font-size:14px;">{{$comment->user->name}}
                                      @if (Auth::user()->id == $comment->user_id)
                                        <form action="{{route('eliminar_comentario', ['id' => $comment->id])}}" class="d-inline form-eliminar-comentario" style="float:right;" method="POST">
                                            @csrf @method("delete")
                                            <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar comentario">
                                                <i class="fa fa-fw fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                      @endif
                                      <a class="btn-accion-tabla" data-toggle="tooltip" data-placement="bottom" style="float:right;" title="{{$comment->created_at->diffForHumans()}}">
                                        <i class="fa fa-clock"></i>
                                      </a>
                                    </a>
                                  </span>
                                  <p>
                                      &nbsp;&nbsp;{{$comment->message}}
                                  </p>
                                  
                                </div>
                              </div>
                            @endif
                          @endif
                        @endforeach 

                        @if($comments->where('post_id', $imgCollection->id)->count() > 1) 
                          <div class="text-center">
                            <a href="{{route('mostrar_comentarios', [$user->id, $imgCollection->id])}}" class="uppercase">Ver comentarios</a>
                            
                          </div>
                        @endif

                        <hr>
                    </div>
                  </div>
              @endforeach
            </div>
            @else
              @if (Auth::user()->id == $user->id)
                <div class="active tab-pane" id="activity">
                  <div class="container">
                    <b>Nombre y apellido:</b> <a>{{$user->name}}</a><br>
                    <b>Correo:</b> <a>{{$user->email}}</a><br>
                    <b>Teléfono:</b> <a>{{$perfil->phone}}</a><br>
                    <b>Fecha de nacimiento:</b> <a>{{date('d-m-Y', strtotime($perfil->date_born))}}</a>
                  </div>
                </div>
                <br>
                <div style="margin-left:15px;">
                  <a href="{{ route('config', [ Auth::user()->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Publicar Perfil
                  </a>
                </div>
              @else
                <div class="active tab-pane" id="activity">
                  <div class="container">
                    <div class="alert alert-info alert-dismissible">
                      {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
                      <h5><i class="icon fas fa-info"></i> Alert!</h5>
                        Perfil privado <i class="fas fa-user-lock fa-2x"></i>
                    </div>
                  </div>
                </div>
              @endif

            @endif
          </div>  
        </div>
      </div>
    </div>
@endsection
{{-- @endif --}}