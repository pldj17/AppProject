@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section("styles")
    {{-- <link href="{{asset("assets/css/gallery.css")}}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('scripts')
    <script src="{{asset("assets/profile/js/perfil.js")}}" type="text/javascript"></script>
    <script src="{{ asset ('assets/photo/js.js') }}"></script>
    <script src="{{asset("assets/js/galeria.js")}}"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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
              <a href="{{route("profile.edit")}}" class="float-right btn-tool" style="position:absolute;">
                  <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar perfil"></i>
              </a>
            <div class="text-center">
              {{-- <img class="profile-user-img img-fluid img-circle"
                   src="../../dist/img/user4-128x128.jpg"
                   alt="User profile picture"> --}}
                      @if (empty(Auth::user()->profile->avatar))
                          <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:130px; width:130px;">
                      @else
                          <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}"  class="card-img-top d-block" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
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
            
            <a href="#" class="btn btn-primary btn-block"><b>Puntuar</b></a> 
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

            <p class="text-muted">Malibu, California</p>

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
                  <a class="nav-link " href="{{route("profile.index")}}">
                      Actividades
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="{{route("perfil_post")}}">
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

                @include('profile.form-gallery')

                <hr>

                {{-- <form action="{{ route('guardar_post') }}" class="form-image-upload" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="col-md-5">
                            <strong>Descripcion:</strong>
                            <input type="text" name="description" class="form-control" placeholder="Descripción">
                        </div>  
                        <div class="col-md-5">
                            <strong>Imagen:</strong>
                            <input type="file" name="image" class="form-control inputfile inputfile-1">
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form> --}}

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection