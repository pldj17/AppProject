@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => auth()->user()->name
    ])   

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-10 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Editar Perfil') }}</h3>
                        </div>
                    </div>
                    {{-- cambiar foto de perfil --}}
                    {{-- <div class="col-md-3 float-right">
                        <div class="card">
                            <div class="card-header">
                                Actualizar foto de perfil
                            </div> <br> --}}
                            {{-- avatar --}}
                            {{-- @if (empty(Auth::user()->profile->avatar))
                                <img src="{{ asset('avatar/avatar.png')}}" width="100%" style="width:100%">
                            @else
                                <img src="{{ asset('uploads/avatar')}}/{{ Auth::user()->profile->avatar }}" width="100%" style="width:100%">    
                            @endif
                            
                            <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="card-body">
                                    <input type="file" class="form-control" name="avatar" enctype="multipart/form-data">
                                    <br>
                                    <button class="btn btn-success float-right" type="submit">Guardar cambios</button>
                                    @if ($errors->has('avatar'))
                                        <div class="error text-danger">{{ $errors->first('avatar')}}</div>                        
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div> --}}

                    <div class="card-body">                                
                        <h6 class="heading-small text-muted mb-4">{{ __('Actualizar foto de perfil') }}</h6>

                        <div class="pl-lg-4">
                            <div class="rounded-circle">
                                <a href="#">
                                    @if (empty(Auth::user()->profile->avatar))
                                        <img src="{{ asset('avatar/avatar.png')}}" class="card-img-top rounded-circle mx-auto" style="width:200px; height:200px; margin:20px;">
                                    @else
                                        <img src="{{ asset('uploads/avatar')}}/{{ Auth::user()->profile->avatar }}" class="card-img-top rounded-circle mx-auto " style="width:200px; height:200px; margin:20px;">  
                                    @endif
                                </a>
                            </div>

                                <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data"> 
                                    @csrf
                                    <div class="card-body">
                                        <input type="file" class="form-control" name="avatar" enctype="multipart/form-data" style="width:170px;">
                                        <div class="text-center">
                                                <button type="submit" class="btn btn-success mt-4">{{ __('Guardar cambios') }}</button>
                                            </div>
                                        @if ($errors->has('avatar'))
                                            <div class="error text-danger">{{ $errors->first('avatar')}}</div>                        
                                        @endif
                                    </div>
                                </form>
                        </div>
                    <hr class="my-4" />
                    </div>


                    {{-- cambiar informacion basica --}}
                    <div class="card-body">
                        <form action="{{ route('profile.create') }}" method="POST" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Información básica') }}</h6>

                            <div class="pl-lg-4">
                                {{-- editar direccion --}}
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Dirección</label>
                                    <input type="text" placeholder="Dirección" class="form-control" name="direccion" value="{{Auth::user()->profile->direccion }}">

                                    @if ($errors->has('direccion'))
                                        <div class="error text-danger">{{ $errors->first('direccion')}}</div>                        
                                    @endif
                                </div>

                                {{-- editar telefono --}}
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Telefono</label>
                                    <input type="text" placeholder="Teléfono" class="form-control" name="telefono" value="{{Auth::user()->profile->telefono }}">

                                    @if ($errors->has('telefono'))
                                        <div class="error text-danger">{{ $errors->first('telefono')}}</div>                        
                                    @endif
                                </div>
                                
                                {{-- editar descripcion --}}
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Descripción</label>
                                    <input type="text" placeholder="Descripción" class="form-control" name="descripcion" value="{{Auth::user()->profile->descripcion }}">

                                    @if ($errors->has('descripcion'))
                                        <div class="error text-danger">{{ $errors->first('descripcion')}}</div>                        
                                    @endif
                                </div>
                                

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Guardar cambios') }}</button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4" />
                </div>

                {{-- cambiar nombre y email --}}
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Información general') }}</h6>
                        
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Nombre y Apellido') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre y Apellido') }}" value="{{ old('name', auth()->user()->name) }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Guardar cambios') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                </div>

                {{-- cambiar contrasena --}}
                <div class="card-body">
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Cambiar contraseña') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">Contraseña actual</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña actual') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">Contraseña nueva</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña nueva') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">Repetir contraseña nueva</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Repetir contraseña nueva') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Guardar cambios</button>
                                </div>
                            </div>
                        </form>
                </div>

                @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
                @endif
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection