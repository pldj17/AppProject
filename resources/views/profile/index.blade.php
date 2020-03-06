@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    {{-- <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script> --}}

    <script src="{{ asset ('assets/profile/js/perfil.js') }}"></script>
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
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
            
              @include('includes.icon_editar_perfil')
                
              <div class="text-center">
                @if (empty($perfil->avatar))
                    <img src="{{ asset('avatar/avatar.png')}}" class="profile-user-img img-fluid img-circle" style="height:130px; width:130px;">
                @else
                    <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}" rel="ligthbox" class="profile-user-img img-fluid img-circle" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
                @endif
              </div>

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              

              @if ($perfil->private == 0 )
                @if(empty($perfil->address) && (Auth::user()->id == $user->id))
                  <center><i class="fas fa-map-marker-alt mr-1"></i>
                  <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Ubicación</small></a>
                @else
                  <center><i class="fas fa-map-marker-alt mr-1"></i>
                  <small class="text-muted">{{$perfil->address}}</small>
                @endif
              @endif
              <br><br></center>
                  
              @if ($perfil->private == 0 )
                <a href="#" class="btn btn-primary btn-block"><b>Calificar</b></a>                   
              @endif
            </div>
          </div>

          <!-- About Me Box -->
          @if ($perfil->private == 0 )
            @include('profile.about_me')
          @endif
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            @if ($perfil->private == 0 )
              @include('includes.tabs')
            @else
              @include('includes.tabsPrivate')
            @endif
            <div class="card-body">
              <div class="tab-content">

              @if($perfil->private == 0 )

                @if (Auth::user()->id == $user->id)

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
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Descripción"></textarea>
                                </div>  
                            </div>
                            
                            <div class="col-md-5 mr--1">
                              <input type="file" class="custom-file-input" name="file[]" id="file" accept="image/*" multiple />
                              
                                {{-- <input type="file" class="custom-file-input" id="customFile" name="image">--}}
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
              @foreach ($photo as $imgCollection)
                
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
                              <div class="btn-group" style="float:right;">
                                <button type="button" class="btn btn-tool" data-toggle="dropdown" style="display:">
                                  <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" id="tabla-data" role="menu">
                                  <a href="#" class="dropdown-item"><i class="fa fa-edit"></i>&nbsp; <small>Editar</small></a>
                                  
                                  @foreach ($imgCollection as $post)

                                    <form action="{{route('eliminar_post', ['id' => $post->post_id])}}" class="d-inline form-eliminar" method="POST"   >
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
                            
                          </span>

                          @foreach ($imgCollection as $post)
                            @if ($loop->first)
                            <span class="description" title="{{ $post->created_at->format('d-m-Y H:i') }}">{{$post->created_at->diffForHumans()}} </span>
                          
                        </div>
                          
                            {{ implode(',', $post->post()->get()->pluck('description')->toArray())}}
                          @endif
                        @endforeach
                        
                        <div class="row" style="margin-top:10px;" id="tabla-data">

                            @foreach ($imgCollection as $post)
                              <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                                <a href="/images/{{$post->file }}" class="fancybox" rel="ligthbox" style="width:100%; height:70%">
                                  <img src="/images/{{$post->file }}" class="zoom img-fluid" alt="" style="width:100%; height:100%">
                                </a>   
                              </div>
                            @endforeach
                        
                        </div>

                        <form action="#" method="post">
                          @if (empty(Auth::user()->profile->avatar))
                            <img class="img-fluid img-circle img-sm" src="{{ asset('avatar/avatar.png')}}" alt="Alt Text">
                          @else
                            <img class="img-fluid img-circle img-sm" src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}" alt="Alt Text">  
                          @endif
                          <div class="img-push">
                            <input type="text" class="form-control form-control-sm" placeholder="Agregar comentario...">
                            {{-- <div class="input-group-append">
                              <button type="submit" class="btn btn-primary">Enviar</button>
                            </div> --}}
                          </div>
                        </form>
                        {{-- <form class="form-horizontal">
                          <div class="input-group input-group-sm mb-0">
                            <input class="form-control form-control-sm" placeholder="Agregar comentario...">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                          </div>
                        </form> --}}
                        
                        <hr>
                    </div>
                  </div>
                <br>
              @endforeach
            </div>
            @else

              <div class="active tab-pane" id="activity">
                <div class="container">
                  <b>Nombre y apellido:</b> <a>{{$user->name}}</a><br>
                  <b>Correo:</b> <a>{{$user->email}}</a><br>
                  <b>Fecha de nacimiento:</b> <a>{{date('d-m-Y', strtotime($perfil->date_born))}}</a>
                </div>
              </div>

              <div class="card-body" style="width:90%;">
                <button type="button" class="btn btn-primary btn-block" >
                  Publicar perfil
                </button>
                
              </div>

            @endif
          </div>  
        </div>
      </div>
    </div>
@endsection