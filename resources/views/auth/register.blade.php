@extends("theme.$theme.app", ['class' => 'bg-default'])

@section('content')
    @include("theme.$theme.headers.guest")

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    {{-- <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-4"><small>{{ __('Sign up with') }}</small></div>
                        <div class="text-center">
                            <a href="#" class="btn btn-neutral btn-icon mr-4">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">{{ __('Github') }}</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">{{ __('Google') }}</span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Registrarse') }}</small>
                        </div>
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf

                             {{-- nombre --}}
                             <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
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
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
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
                                <div class="input-group input-group-alternative mb-3">
                                    {{-- <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div> --}}
                                    <input id="datepicker" readonly="readonly"  type="text" placeholder="Fecha de nacimiento" class="form-control @error('date') is-invalid @enderror" name="date_born" value="{{ old('date_born') }}"  autocomplete="date_born">
                                </div>
                                @if ($errors->has('date_born'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('date_born') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- email --}}
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
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
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
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
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="pass" class="form-control" placeholder="{{ __('Confirmar contraseña') }}" type="password" name="password_confirmation">
                                    {{-- <i class="fa fa-eye" id="show" style="margin-top:4%; margin-left:2%; margin-right:2%;"></i> --}}
                                </div>
                            </div>
                            

                            {{-- politicas de privacidad --}}
                            {{-- <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">{{ __('I agree with the') }} <a href="#!">{{ __('Privacy Policy') }}</a></span>
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- crear cuenta --}}
                            <div class="text-center">
                                <button type="submit" id="btnvalidar" class="btn btn-primary mt-4" value="Validar">{{ __('Crear cuenta') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-right">
                        <small>¿Ya eres miembro?</small>
                        <a href="{{ route('login') }}" class="text-light">
                            <small>{{ __('Iniciar sesión') }}</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
