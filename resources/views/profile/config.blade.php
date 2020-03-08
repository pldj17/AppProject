@extends("theme.$theme.app")

@section('titulo')
    Configuración
@endsection

@section('scripts')

@endsection

@section('styles')

@endsection

@section('title')
    <h2>Configuración</h2>
@endsection

@section('contenido')
<div class="container-fluid">
    @include('includes.form-error')
    @include('includes.mensaje')

    {{-- collapsed-card para mantener cerrado --}}

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Privacidad de perfil</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i></button>
              {{-- icon + = plus --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('config', [$user->id]) }}" method="POST" autocomplete="">
                @csrf
                <div class="form-group">
                    <div class="custom-control custom-checkbox" id="perfil_private">
                        <input class="custom-control-input" type="checkbox" name="private" id="private" value="1" {{ $perfil->private || old('private', 2) === 1 ? 'checked' : '' }}>
                        <label for="private" class="custom-control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perfil publico</label>
                    </div>
                    @if($errors->has('active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('active') }}
                        </div>
                    @endif
                </div>
                <div class="text-center" style="margin-top:23px;">
                    @include('profile.boton-form-editar')
                </div>
        </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Información básica</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('update_inf') }}" method="POST" autocomplete="">
                @csrf
                <div class="pl-lg-4">

                    <div class="form-group">
                        <label for="">Nombre y Apellido</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name ?? ''}}">
                        @if ($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name')}}</div>                        
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control" name="email" value="{{Auth::user()->email ?? ''}}">
                        @if ($errors->has('email'))
                            <div class="error text-danger">{{ $errors->first('email')}}</div>                        
                        @endif
                    </div>

                    <div class="text-center" style="margin-top:23px;">
                        @include('profile.boton-form-editar')
                    </div>
                </div>
            </form>
          </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Reestablecer contraseña</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('update_password') }}" method="POST" autocomplete="">
                @csrf
                <div class="pl-lg-4">

                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-current-password">Contraseña actual</label>
                        <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" value="" required>
                        
                        @if ($errors->has('old_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative">
                            <label class="form-control-label" for="input-current-password">Contraseña nueva</label>
                            <input id="pass" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password">
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        <div class="input-group-alternative">
                            <label class="form-control-label" for="input-current-password">Confirmar contraseña</label>
                            <input id="pass" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password_confirmation">
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="text-center" style="margin-top:23px;">
                        @include('profile.boton-form-editar')
                    </div>
                </div>
            </form>
          </div>
    </div>

</div>
@endsection