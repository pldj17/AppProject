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
                <a href="{{route("profile.edit")}}" class="float-right btn-tool" style="position:absolute;">
                    <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar perfil"></i>
                </a>
              <div class="text-center">
                @if (empty(Auth::user()->profile->avatar))
                    <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:130px; width:130px;">
                @else
                    <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}" rel="ligthbox" class="card-img-top d-block" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
                @endif
              </div>

              <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

              <p class="text-muted text-center">Software Engineer</p>

              {{-- <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Followers</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="float-right">13,287</a>
                </li>
              </ul>--}}
              
              <a href="#" class="btn btn-primary btn-block"><b>Calificar</b></a> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Sobre Mi</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i>Formación</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>

              <p class="text-muted">{{Auth::user()->profile->address ?? 'Agregar ubicacion'}}</p>

              <hr>

              <strong><i class="fas fa-pencil-alt mr-1"></i> Especialidad</strong>

              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="far fa-file-alt mr-1"></i> Notas</strong>

              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route("profile.index")}}">
                      Actividades
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route("perfil_post")}}">
                        Fotos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#settings" data-toggle="tab">
                        Contactos
                    </a>
                </li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                
                  <div >
                    <div class="container">
                        <form action="{{ route('guardar_post') }}" class="form-image-upload" method="POST" enctype="multipart/form-data" autocomplete="off">
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

            </div><!-- /.card-body -->


            {{-- <div class="card-body">
              @foreach ($photo as $imgCollection)
              <h4>publicación</h4>
                @foreach ($imgCollection as $post)
                  <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                          <div class="post">
                              <div class="row mb-3">
                                  <div class="col-lg-6 col-md-4 col-xs-6 thumb">
                                      <a href="images/{{$post->file }}" class="fancybox" rel="ligthbox">
                                          <img src="images/{{$post->file }}" class="zoom img-fluid">
                                      </a>
                                  </div>                      
                              </div>

                              <div>
                                {{$post->description}}
                              </div>
                          </div>
                      </div>
                  </div>
                @endforeach
                <hr>
              @endforeach
            </div> --}}



            <div class="card-body" id="tabla-data">
              @foreach ($photo as $imgCollection)
                
                    <div class="active tab-pane" id="activity">
                      <div class="post">
                        <div class="user-block">
                          @if (empty(Auth::user()->profile->avatar))
                              <img src="{{ asset('avatar/avatar.png')}}" class="img-circle img-bordered-sm">
                          @else
                              <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}"  class="img-circle img-bordered-sm">  
                          @endif
                          <span class="username">
                            <a href="#">{{auth()->user()->name}}</a>
                              <div class="btn-group" style="float:right;">
                                <button type="button" class="btn btn-tool" data-toggle="dropdown" style="display:">
                                  <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" id="tabla-data" role="menu">
                                  <a href="#" class="dropdown-item"><i class="fa fa-edit"></i>&nbsp; <small>Editar</small></a>
                                  <form action="#" class="d-inline form-eliminar" method="POST"  onsubmit="setTimeout(function () { window.location.reload(); }, 2500)" >
                                    <input type="hidden" name="_method" value="delete">
                                    @csrf 
                                    <button type="submit"  class="btn-accion-tabla eliminar" style="margin-left:20px;" >
                                      <i class="fa fa-trash text-danger"></i>&nbsp; Eliminar
                                    </button>
                                  </form>
                                  <a href="#" class="dropdown-item"><i class="fa fa-trash text-danger"></i>&nbsp; <small>Eliminar</small></a>
                                </div>
                              </div>
                            
                          </span>



                          {{-- @foreach ($imgCollection as $post)
                          <span class="description" title="{{ $post->created_at->format('d-m-Y') }}">{{$post->created_at->diffForHumans()}} </span>
                          @endforeach --}}
                        </div>
                        {{-- <p>{{$post->description}}</p> --}}
{{--                 
                  @foreach($posts as $pub)
                      <p>{{$pub->description}}</p>
                  @endforeach
                           --}}
                <div class="row" style="margin-top:10px;" id="tabla-data">
                  @foreach ($imgCollection as $post)
                    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                      <a href="images/{{$post->file }}" class="fancybox" rel="ligthbox" style="width:100%; height:70%">
                        <img src="images/{{$post->file }}" class="zoom img-fluid" alt="" style="width:100%; height:100%">
                      </a>                     
                    </div>
                  @endforeach
                </div>
                  <p>
                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                    <span class="float-right">
                      <a href="#" class="link-black text-sm">
                        <i class="far fa-comments mr-1"></i> Comments (5)
                      </a>
                    </span>
                  </p>

                  <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                  
                  </div>
                </div>
              <br>
              @endforeach
            </div>
            
          </div>  


@endsection

{{-- <script>
  $(document).ready(function(){
      $('form').ajaxForm({
          beforeSend:function(){
              $('#success').empty();
              $('.progress-bar').text('0%');
              $('.progress-bar').css('width', '0%');
          },
          uploadProgress:function(event, position, total, percentComplete){
              $('.progress-bar').text(percentComplete + '0%');
              $('.progress-bar').css('width', percentComplete + '0%');
          },
          success:function(data)
          {
              if(data.success)
              {
                  $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
                  $('#success').append(data.image);
                  $('.progress-bar').text('Uploaded');
                  $('.progress-bar').css('width', '100%');
              }
          }
      });
  });
  </script> --}}