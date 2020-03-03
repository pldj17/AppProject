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

            @include('includes.icon_editar_perfil')

            <div class="text-center">
                   @if (empty($perfil->avatar))
                      <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto d-block" style="height:130px; width:130px;">
                  @else
                      <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}" rel="ligthbox" class="card-img-top d-block" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
                  @endif
            </div>

            <h3 class="profile-username text-center">{{$user->name}}</h3>

              @if (($perfil->private == 0))
                @if(empty($perfil->address) && (Auth::user()->id == $user->id))
                  <center><i class="fas fa-map-marker-alt mr-1"></i>
                  <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Ubicación</small></a>
                @else
                  <center><i class="fas fa-map-marker-alt mr-1"></i>
                  <small class="text-muted">{{$perfil->address}}</small>
                @endif
              @endif
              <br><br></center>

            
              @if (($perfil->private == 0))
                <a href="#" class="btn btn-primary btn-block"><b>Calificar</b></a>                   
              @endif
          </div>
        </div>

        <!-- About Me Box -->
        @if (($perfil->private == 0))
          @include('profile.about_me')
        @endif
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          @if (($perfil->private == 0))
              @include('includes.tabs')
            @else
              @include('includes.tabsPrivate')
            @endif
          <div class="card-body">
            <div class="tab-content">

                @include('profile.form-gallery')

                <hr>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection