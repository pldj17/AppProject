<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrarse</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css")}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/adminlte.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="{{asset("dashboard")}}"><b>App</b>Project</a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                <p class="login-box-msg">Registrarse</p>

                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- nombre --}}
                    <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative mb-3">
                            <input id="nombre" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" type="text" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- apellido --}}
                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative mb-3">
                            <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Apellido') }}" type="text" name="last_name" value="{{ old('last_name') }}">
                        </div>
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- fecha de nacimiento --}}
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative mb-3">
                            <input class="form-control{{ $errors->has('date_born') ? ' is-invalid' : '' }}" type="date" name="date_born" max="3000-12-31" min="1000-01-01" name="date_born" value="{{ old('date_born') }}"  autocomplete="date_born">
                            {{-- <input readonly="readonly"  type="date" placeholder="Fecha de nacimiento" class="form-control @error('date') is-invalid @enderror" name="date_born" value="{{ old('date_born') }}"  autocomplete="date_born"> --}}
                        </div>
                        @if ($errors->has('date_born'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('date_born') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- email --}}
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative mb-3">
                            {{-- <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div> --}}
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- contrasena --}}
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative">
                            {{-- <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div> --}}
                            <input id="pass" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}" type="password" name="password">
                            {{-- <i class="fa fa-eye" id="show" style="margin-top:4%; margin-left:2%; margin-right:2%;"></i> --}}
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- confirmar contrasena --}}
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative">
                            <input id="pass" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirmar contraseña') }}" type="password" name="password_confirmation">
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- crear cuenta --}}
                    <div class="text-center">
                        <button type="submit" id="btnvalidar" class="btn btn-primary mt-4" value="Validar">{{ __('Crear cuenta') }}</button>
                    </div>
                </form>

                <div class="row mt-3">
                    <div class="col-12 text-right">
                        <a href="{{ route('login') }}" class="text-center">¿Ya eres miembro?</a>
                    </div>
                </div>

            
            </div><!-- /.card -->
        </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>
    </body>
</html>
