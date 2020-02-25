@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>

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
      @include('includes.mensaje')
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
            
              @include('includes.icon_editar_perfil')
                
              <div class="text-center">
                @if (empty($perfil->avatar))
                    <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:130px; width:130px;">
                @else
                    <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}" rel="ligthbox" class="card-img-top d-block" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
                @endif
              </div>

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <center><i class="fas fa-map-marker-alt mr-1"></i>

              @if (empty($perfil->address) && (Auth::user()->id == $user->id))
                <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Ubicación</small></a>
              @else
                <small class="text-muted">{{$perfil->address ?? 'Sin ubicacion'}}</small>
              @endif
              <br><br></center>
             

              {{-- <p class="text-muted text-center">Software Engineer</p> --}}
              
              <a href="#" class="btn btn-primary btn-block"><b>Calificar</b></a> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
            @include('profile.about_me')
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">

            @include('includes.tabs')
            
            <div class="card-body">
              <div class="tab-content">

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

                                    <form action="{{route('eliminar_post', ['id' => $post->post_id])}}" class="d-inline form-eliminar" method="POST"  onsubmit="setTimeout(function () { window.location.reload(); }, 2500)" >
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

                <form class="form-horizontal">
                  <div class="input-group input-group-sm mb-0">
                    <input class="form-control form-control-sm" placeholder="Agregar comentario...">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                  </div>
                </form>
                  
                  </div>
                </div>
              <br>
              @endforeach
            </div>
            
          </div>  
        </div>
      </div>
    </div>
@endsection