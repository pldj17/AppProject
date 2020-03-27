@extends("theme.$theme.app")

@section('titulo')
    Editar perfil
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{asset("assets/$theme/plugins/select2/js/select2.full.min.js")}}"></script>
    <script>var url = "{{ route('avatar', [$user->id]) }}";</script>
    <script src="{{ asset ('assets/photo/js.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/5.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCPtKyI4BdM48KZ5rZNtF_SCGTXGjk1C8c"></script>
    <script src="{{asset("assets/profile/js/localization.js")}}"></script>
        <!-- InputMask -->
    <script src="{{asset("assets/$theme/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/$theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js")}}"></script>
    

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
<div class="container-fluid">
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
                            @if (empty($perfil->avatar))
                                <img src="{{ asset('avatar/avatar.png')}}" id="profile-pic">
                            @else
                                <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}" id="profile-pic">  
                            @endif
                            {{-- <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}" id="profile-pic" > --}}
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
            <h3 class="card-title">Información básica</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('guardar_perfil', [$user->id]) }}" method="POST" autocomplete="">
                @csrf
                <div class="pl-lg-4">
                     
                    <div class="form-group">
                      <label>Localización</label>
                      <input type="text" class="form-control" name="address_address" id="search_input" value="{{Auth::user()->profile->address_address ?? ''}}"/>
                      {{-- <input type="hidden" id="latitude_input" name="latitude_input"/>
                      <input type="hidden" id="longitude_input" name="longitude_input"/> --}}
                    </div>
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea name="description" id="" cols="" rows="" class="form-control" placeholder="Escribe acerca de ti">{{Auth::user()->profile->description ?? ''}}</textarea>
                        @if ($errors->has('description'))
                            <div class="error text-danger">{{ $errors->first('description')}}</div>                        
                        @endif
                    </div>
                    
                    @if($perfil->private == 1 )

                    <div class="form-group">
                      <label for="especialidades">Especialidad</label><br>
                          
                         <select class="select2bs4 {{ $errors->has('especialidades') ? 'is-invalid' : '' }}" name="especialidades[]" id="especialidades" multiple data-placeholder="Puede seleccionar mas de uno" style="width: 100%;">
                            @foreach($especialidades as $id => $especialidades)
                                <option value="{{ $id }}" {{ (in_array($id, old('especialidades', [])) || $user->especialidades->contains($id)) ? 'selected' : '' }}>{{ $especialidades }}</option>
                            @endforeach
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                         </select>

                        @if($errors->has('especialidades'))
                            <div class="invalid-feedback">
                                {{ $errors->first('especialidades') }}
                            </div>
                        @endif
                    </div>
                    <div class="text-center" style="margin-top:60px;">
                      {{-- @include('profile.boton-form-editar') --}}
                  </div>
                    @endif

                    @if($perfil->private != 1)
                      <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" class="form-control" placeholder="Ingrese su número de teléfono" name="phone" value="{{Auth::user()->profile->phone ?? ''}}">
                        @if ($errors->has('phone'))
                            <div class="error text-danger">{{ $errors->first('phone')}}</div>                        
                        @endif
                      </div>
                      <div class="text-center" style="margin-top:23px;">
                        @include('profile.boton-form-editar')
                      </div>
                    @endif
                    
                    
                </div>
            {{-- </form> --}}
          </div>
        </div>
      </div>

    </div>

    @if($perfil->private == 1 )
 
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Información de contacto</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                {{-- <form action="{{ route('guardar_contatc', [$user->id]) }}" method="POST" autocomplete="">
                  @csrf --}}
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="">Teléfono</label>
                          <input type="text" class="form-control" placeholder="Ingrese su número de teléfono" name="phone" value="{{Auth::user()->profile->phone ?? ''}}">
                          @if ($errors->has('phone'))
                              <div class="error text-danger">{{ $errors->first('phone')}}</div>                        
                          @endif
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Mail</label>
                        <input type="text" class="form-control" placeholder="Ingrese su correo electrónico" name="correo" value="{{Auth::user()->profile->correo ?? ''}}">
                        @if ($errors->has('correo'))
                            <div class="error text-danger">{{ $errors->first('correo')}}</div>                        
                        @endif
                      </div>
                    </div>
                  </div>

                  <label for="">Redes sociales:</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="">Facebook</label>
                          <input type="text" class="form-control" placeholder="Agregue link de su perfil de facebook" name="facebook" value="{{Auth::user()->profile->facebook ?? ''}}">
                          @if ($errors->has('facebook'))
                              <div class="error text-danger">{{ $errors->first('facebook')}}</div>                        
                          @endif
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Número de Whatsaap</label>
                        <input type="text" class="form-control" placeholder="" name="whatsaap" value="{{Auth::user()->profile->whatsaap ?? ''}}">
                        @if ($errors->has('whatsaap'))
                            <div class="error text-danger">{{ $errors->first('whatsaap')}}</div>                        
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="text-center" style="margin-top:23px;">
                    @include('profile.boton-form-editar')
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      @endif

    @endsection
   