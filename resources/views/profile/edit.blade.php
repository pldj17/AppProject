@extends("theme.$theme.app")

@section('titulo')
    Editar perfil
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{asset("assets/$theme/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{ asset ('assets/photo/js.js') }}"></script>
@endsection

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/profile/css/edit.css') }}">
@endsection

@section('title')
    <h2>Editar perfil</h2>
@endsection

@section('contenido')

<section class="content">
    @include('includes.form-error')
            @include('includes.mensaje')
    <div class="row">
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Actualizar foto de perfil</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
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
                    </div><br>
                </div>
            </div>
        
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar foto</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">información básica</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('profile.create') }}" method="POST" autocomplete="off">
                @csrf
                <div class="pl-lg-4">
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" class="form-control" name="phone" value="{{Auth::user()->profile->phone ?? ''}}">
                        @if ($errors->has('phone'))
                            <div class="error text-danger">{{ $errors->first('phone')}}</div>                        
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::user()->profile->address ?? ''}}">
                        @if ($errors->has('address'))
                            <div class="error text-danger">{{ $errors->first('address')}}</div>                        
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea name="description" id="" cols="" rows="" class="form-control">{{Auth::user()->profile->description ?? ''}}</textarea>
                        @if ($errors->has('description'))
                            <div class="error text-danger">{{ $errors->first('description')}}</div>                        
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="especialidad">Especialidad</label><br>
                        {{-- <select id="sel" class="select" name="especialidad[]" multiple="multiple"> --}}
                            <select class="select2bs4" name="especialidad[]" multiple="multiple" data-placeholder="" style="width: 100%;">
                                @foreach($especialidad as $id => $especialidad)
                                   <option value="{{ $id }}" {{ in_array($id, old('especialidad', [])) ? 'selected' : '' }}>{{ $especialidad }}</option>
                               @endforeach
                           </select>  
                        @if($errors->has('especialidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('especialidad') }}
                            </div>
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

                    <div class="text-center" style="margin-top:23px;">
                        @include('profile.boton-form-editar')
                    </div>
                </div>
            </form> 
          </div>
        </div>
      </div>
    </div>
   
  </section>

    
    @endsection