@extends("theme.$theme.app")

@section('titulo')
    Editar perfil
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{asset("assets/$theme/plugins/select2/js/select2.full.min.js")}}"></script>
    <script>var url = "{{ route('avatar', [$user->id]) }}";</script>
    <script src="{{ asset ('assets/photo/js.js') }}"></script>

        <!-- InputMask -->
    {{-- <script src="{{asset("assets/$theme/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/$theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js")}}"></script> --}}
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
            <h3 class="card-title">información básica</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('guardar_perfil', [$user->id]) }}" method="POST" autocomplete="">
                @csrf
                <div class="pl-lg-4">

                    {{-- <div class="form-group">
                        <label>US phone mask:</label>
      
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                          </div>
                          <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                        </div>
                      </div> --}}

                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" class="form-control" name="phone" value="{{Auth::user()->profile->phone ?? ''}}">
                        @if ($errors->has('phone'))
                            <div class="error text-danger">{{ $errors->first('phone')}}</div>                        
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea name="description" id="" cols="" rows="" class="form-control">{{Auth::user()->profile->description ?? ''}}</textarea>
                        @if ($errors->has('description'))
                            <div class="error text-danger">{{ $errors->first('description')}}</div>                        
                        @endif
                    </div>
                    
                    @if($perfil->private == 1 )

                    <div class="form-group">
                      <label for="especialidades">Especialidad</label><br>
                          
                         <select class="select2bs4 {{ $errors->has('especialidades') ? 'is-invalid' : '' }}" name="especialidades[]" id="especialidades" multiple data-placeholder="" style="width: 100%;">
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

                    @endif

                    <div class="text-center" style="margin-top:23px;">
                        @include('profile.boton-form-editar')
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>

    </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <div class="card-header">
              <h5 class="card-title">Agregar dirección</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                {{-- <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                  </div>
                </div> 
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>--}}
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group">
                    <label for="">Dirección</label>
                    <input type="text" class="form-control" name="address" value="{{Auth::user()->profile->address ?? ''}}">
                    @if ($errors->has('address'))
                        <div class="error text-danger">{{ $errors->first('address')}}</div>                        
                    @endif
                    <div class="form-group">
                        <label for="address">{{ trans('cruds.shop.fields.address') }}</label>
                        <input class="form-control map-input {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $shop->address) }}">
                        <input type="hidden" name="latitude" id="address-latitude" value="{{ old('latitude', $shop->latitude) ?? '0' }}" />
                        <input type="hidden" name="longitude" id="address-longitude" value="{{ old('longitude', $shop->longitude) ?? '0' }}" />
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.shop.fields.address_helper') }}</span>
                    </div>
                    <div id="address-map-container" class="mb-2" style="width:100%;height:400px; ">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    
    

    @endsection
    @section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize&language=en&region=GB" async defer></script>
<script src="assets/js/mapInput.js"></script>
@endsection