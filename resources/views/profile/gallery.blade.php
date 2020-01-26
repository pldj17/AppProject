@extends("theme.$theme.app")

@section('titulo')
    Perfil
@endsection

@section("styles")
    {{-- <link href="{{asset("assets/css/gallery.css")}}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('scripts')
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
    @include('includes.mensaje')
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
              <a href="{{route("profile.edit")}}" class="float-right btn-tool" style="position:fixed;">
                  <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar perfil"></i>
              </a>
            <div class="text-center">
              {{-- <img class="profile-user-img img-fluid img-circle"
                   src="../../dist/img/user4-128x128.jpg"
                   alt="User profile picture"> --}}
                   <a href="#" class="zoom img-fluid" style="">
                      @if (empty(Auth::user()->profile->avatar))
                          <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:130px; width:130px;">
                      @else
                          <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}"  class="card-img-top d-block fancybox" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
                      @endif
                  </a>
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
                <form action="{{ route('guardar_post') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <strong>Descripcion:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Descripción">
                        </div>  
                        <div class="col-md-5">
                            <strong>Imagen:</strong>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    {{-- <div class="container-fluid mt--7 justify-content-center">
        
        <div class="row justify-content-md-center">
            <div class="col-11 order-xl-2 mb-4 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @if (empty(Auth::user()->profile->avatar))
                                        <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:150; width:250px;">
                                    @else
                                        <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}" class="card-img-top d-block" style="width:250px; height:150; border-radius:50%;">  
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default float-right">{{ __('Editar perfil') }}</a>
                        </div>
                    </div><br>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col"> --}}
                                {{-- <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">{{ __('Friends') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">{{ __('Photos') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div>
                                </div> --}}
                            {{-- </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light"></span>
                                <h6>Se unió el: {{date('d F, Y', strtotime(Auth::user()->created_at))}}</h6> 
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2">{{Auth::user()->profile->address}}</i>
                            </div> --}}
                            {{-- <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Developer') }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{Auth::user()->profile->description}}
                            </div> --}}
                            {{-- <hr class="my-4" />                         

                            @include('profile.tabs')

                            @include('profile.form-gallery')

                            <hr>
                            <form action="{{ route('guardar_post') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row"> --}}
                                    {{-- <div class="col-md-5">
                                        <strong>Descripcion:</strong>
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                    </div> --}}
                                    {{-- <div class="col-md-5">
                                        <strong>Imagen:</strong>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <br/>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        {{-- @include("layouts.footers.auth") --}}

@endsection