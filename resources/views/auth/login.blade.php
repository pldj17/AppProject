<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <title>Iniciar sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css")>
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/adminlte.min.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
   {{-- firebase --}}
   <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
   <link rel="manifest" href="{{ asset ("manifest.json") }}">

   {{-- loader --}}
   <link rel="stylesheet" href="{{asset("assets/css/loader.css")}}">
 
    {{-- assets de PWA --}}
    @laravelPWA
    
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <div class="login-logo">
    <a href="{{asset("/")}}"><b>App</b>Project</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <div class="loader" id="loader" style="position:absolute; margin-left:50%; margin-right:50%;">Loading...</div>
      <p class="login-box-msg">Iniciar sesión</p>

      <form role="form" method="POST" action="{{ route('login') }}">
        @csrf

        {{-- email --}}
        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
            <div class="input-group-alternative">
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        {{-- password --}}
        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
            <div class="input-group-alternative">
                <input id="pass" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password">
                {{-- <i class="fa fa-eye" id="show" style="margin-top:4%; margin-left:2%; margin-right:2%;"></i> --}}
            </div>
            @if ($errors->has('password'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="text-center">
            <input type="hidden" name="device_token" id="device_token">
            <input type="hidden" name="active" value="1">
            <button type="submit" class="btn btn-primary my-2">{{ __('Ingresar') }}</button>
        </div>
    </form>

    <div class="row">
        <div class="col-12 text-right">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-center">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="{{ route('register') }}" class="text-center">Crear cuenta</a>
        </div>
    </div>
    

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

    <!-- jQuery -->
    <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>

     {{-- firebase --}}
     <script src="{{asset('assets/js/firebase.js')}}"></script>

     {{-- loader --}}
     <script src="{{asset("assets/js/loader.js")}}"></script>


</body>
</html>


