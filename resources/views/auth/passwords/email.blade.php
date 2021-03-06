<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>AdminLTE 3 | Log in</title>
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

  {{-- assets de PWA --}}
  @laravelPWA

</head>
<body class="hold-transition login-page">
    
    <div class="login-box">
        <div class="login-logo">
          <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">¿Olvidó su contraseña? Ingrese su email para recuperar su contraseña.</p>
            @include('includes.mensaje')
            <form role="form" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                    <div class="input-group-alternative">
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">{{ __('Enviar enlace de reestablecimiento') }}</button>
                </div>
            </form>

            <div class="row">
                <div class="col-12 text-right">
                    <a href="{{route("login")}}">Iniciar sesión</a>
                </div>
            </div>
            <div class="row mt">
                <div class="col-12 text-right">
                    <a href="{{route("register")}}" class="text-center">Registrarse</a>
                </div>
            </div>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
<!-- jQuery -->
<script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>

</body>
</html>
