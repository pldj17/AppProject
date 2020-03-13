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