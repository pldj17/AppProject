<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('titulo', 'App') | Proyecto</title>
        {{-- Bootstrap --}}
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
        <!-- Favicon -->
        <link href="{{ asset("assets/$theme/img/brand/favicon.png") }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset("assets/$theme/vendor/nucleo/css/nucleo.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/$theme/vendor/@fortawesome/fontawesome-free/css/all.min.css") }}" rel="stylesheet">
        {{-- <link href="{{ asset("vendor/@fortawesome/fontawesome-free/css/all.min.css") }}" rel="stylesheet"> --}}
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset("assets/$theme/css/argon.css?v=1.0.0") }}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


        @yield("styles")
        
        <link type="text/css" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">


        {{-- datepicker --}}
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.es-es.js" type="text/javascript"></script>

        {{-- cortar foto --}}
        <link rel="stylesheet" type="text/css" href="{{ asset ('photo/fotoPerfil.css') }}">
		<!-- Bootstrap 4 -->
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <!-- Croppie css -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
        <!-- Font Awesome 5 -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        

    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include("theme.$theme.navbars.sidebar")
        @endauth
        
        <div class="main-content">
            @include("theme.$theme.navbars.navbar")
            @include('partials.alerts')
            @yield('contenido')
        </div>

        @guest()
            @include("theme.$theme.footers.guest")
        @endguest

        <script>
            //calendario de registro
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                locale: 'es-es'
            });
        </script>
    
        <script>
            //ojito para ver password
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
        //mostrar modal
        function mostrarModal(titulo) {
            $("#modalTitle").html(titulo);
            $("#myModal").modal("show");
        }
        </script>


        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset("assets/$theme/js/argon.js?v=1.0.0") }}"></script>

        {{-- foto de perfil --}}
        <!--  jQuery and Popper.js  -->
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <!-- Boostrap 4 -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Croppie js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>
        {{-- archivo js --}}
        <script>var url = "{{route('avatar')}}";</script>
        <script src="{{asset('photo/js.js')}}"></script>
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