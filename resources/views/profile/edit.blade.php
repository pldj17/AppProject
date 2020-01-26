@extends("theme.$theme.app")

@section('titulo')
    Editar perfil
@endsection

@section('styles')
  
@endsection

@section('scripts')
    <script src="{{ asset ('assets/photo/js.js') }}"></script>
@endsection

@section('contenido')
    @include('users.partials.header')   

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            
            <div class="col-xl-11 order-xl-2 mb-4 mb-xl-0">
                @include('includes.form-error')
                    @include('includes.mensaje')
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Editar Perfil') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Actualizar foto de perfil') }}</h6>

                        <div  class="container"> 

                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="profile-img p-3">
                                                <img src="{{ asset('/avatar/avatar.png') }}" id="profile-pic" >
                                            </div>
                                            <div class="btn btn-dark btn-sm">
                                                <input type="file" class="file-upload" id="file-upload" 
                                                name="profile_picture" accept="image/*">
                                                Seleccionar nueva foto
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Actualizar foto</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div id="resizer"></div>
                                                <button class="btn rotate float-lef" data-deg="90" > 
                                                <i class="fa fa-undo"></i></button>
                                                <button class="btn rotate float-right" data-deg="-90" > 
                                                <i class="fa fa-redo"></i></button>
                                                <hr>
                                                <button class="btn btn-block btn-dark" id="upload" >Continuar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <hr class="my-4">
                    </div>

                    <div class="card-body">
                        
                            <h6 class="heading-small text-muted mb-4">{{ __('Editar información') }}</h6>
    
                            <form action="{{ route('profile.create') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label for="">Telefono</label>
                                        <input type="text" class="form-control" name="phone" value="{{Auth::user()->profile->phone }}">
                                        @if ($errors->has('phone'))
                                            <div class="error text-danger">{{ $errors->first('phone')}}</div>                        
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Direccion</label>
                                        <input type="text" class="form-control" name="address" value="{{Auth::user()->profile->address }}">
                                        @if ($errors->has('address'))
                                            <div class="error text-danger">{{ $errors->first('address')}}</div>                        
                                        @endif
                                    </div>
            
                                    <div class="form-group">
                                        <label for="">Descripcion</label>
                                        <textarea name="description" id="" cols="" rows="" class="form-control">{{Auth::user()->profile->description}}</textarea>
                                        @if ($errors->has('description'))
                                            <div class="error text-danger">{{ $errors->first('description')}}</div>                        
                                        @endif
                                    </div>
                                    
                                    {{-- <div class="class form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                            </div>
                                            <input class="form-control" type="text" placeholder="Telefono">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="text-center">
                                        @include('profile.boton-form-editar')
                                    </div>
                                </div>
                            </form>   
                                    
                            {{-- @if (Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                            @endif   --}}
    
                        <hr class="my-4" />
                    </div>
    
                    
                </div>
            </div>

        </div>
    </div>

    {{-- @include("layouts.footers.auth") --}}
    
    @endsection