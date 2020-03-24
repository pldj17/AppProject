<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo', 'App') | Proyecto</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/adminlte.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield("styles")
    
    <link type="text/css" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    {{-- cortar foto --}}
    <link rel="stylesheet" type="text/css" href="{{ asset ('photo/fotoPerfil.css') }}">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Croppie css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">


    {{-- select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
  </head>

  <body class="hold-transition sidebar-mini layout-boxed">
    <!-- Site wrapper -->
    <div class="wrapper">

      <!-- Inicio Header -->
      @include("theme/$theme/navbar")
      <!-- Fin Header -->
      <!-- Inicio Aside -->
      @include("theme/$theme/aside")
      <!-- Fin Aside -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header" style="margin-left:3%;">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                @yield('title')
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @yield('bottom')
                </ol>
              </div>
            </div>
          </div>
            
        </section>
        <section class="content">
          @yield('contenido')
        </section>

      </div>

      <!--Inicio Footer -->
      @include("theme/$theme/footer")
      <!-- Fin Footer -->

    </div>

    <script> 
    //  $(document).ready(function() {
    //     $('.select2').select2({
    //       width: '300px'
    //     });
    //   });

    // $(document).ready(function() {
    //     $('.js-example-basic-multiple').select2();
    // });

    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })


    
  </script>
  {{-- <script>
      ojito para ver password
      $(document).ready(function(){
          $('#show').mousedown(function(){
              $('#pass').removeAttr('type');
              $('#show').addClass('fa-eye-slash').removeClass('fa-eye');
          });
          $('#show').mouseup(function(){
              $('#pass').attr('type', 'password');
              $('#show').addClass('fa-eye').removeClass('fa-eye-slash');
          });
      });
  </script>

  <script>
  mostrar modal
  function mostrarModal(titulo) {
      $("#modalTitle").html(titulo);
      $("#myModal").modal("show");
  }
  </script> --}}
    {{-- icon --}}
    {{-- <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script> --}}

    <!-- jQuery -->
    <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>

    {{-- js de app --}}
     <!-- Argon JS -->
     <script src="{{ asset("assets/argon/js/argon.js?v=1.0.0") }}"></script>

     {{-- foto de perfil --}}
     <!--  jQuery and Popper.js  -->
     {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <!-- Boostrap 4 -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <!-- Croppie js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>
     {{-- archivo js --}}
     {{-- <script>var url = "{{ route('avatar') }}";</script> --}}
     <script src="{{ asset ('assets/photo/js.js') }}"></script>
     <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="ea8a63b81a35e8970c2c9439-|49" defer=""></script>
     @yield("scriptsPlugins")
     <script src="{{asset("assets/js/jquery-validation/jquery.validate.min.js")}}"></script>
     <script src="{{asset("assets/js/jquery-validation/localization/messages_es.min.js")}}"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script src="{{asset("assets/js/scripts.js")}}"></script>
     <script src="{{asset("assets/js/funciones.js")}}"></script>
     {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
     
    @yield("scripts")

  </body>
</html>