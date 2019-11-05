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
                    {{-- cambiar informacion basica --}}
                    <div class="card-body">
                            <form action="{{ route('profile.create') }}" method="POST" autocomplete="off">
                                @csrf
    
                                <h6 class="heading-small text-muted mb-4">{{ __('Información básica') }}</h6>
    
                                <div class="pl-lg-4">
                                    {{-- editar direccion --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" value="{{Auth::user()->profile->direccion }}">
    
                                        @if ($errors->has('direccion'))
                                            <div class="error text-danger">{{ $errors->first('direccion')}}</div>                        
                                        @endif
                                    </div>

                                    {{-- editar telefono --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">telefono</label>
                                        <input type="text" class="form-control" name="telefono" value="{{Auth::user()->profile->telefono }}">
    
                                        @if ($errors->has('telefono'))
                                            <div class="error text-danger">{{ $errors->first('telefono')}}</div>                        
                                        @endif
                                    </div>
                                    
                                    {{-- editar descripcion --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" value="{{Auth::user()->profile->descripcion }}">
    
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