@extends("theme.$theme.app")

@section('titulo')
    Inicio
@endsection

@section('scripts')
  
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/5.4.1/jquery.min.js"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCPtKyI4BdM48KZ5rZNtF_SCGTXGjk1C8c"></script>
    <script src="{{asset("assets/profile/js/localization.js")}}"></script>
    <!-- Select2 -->
    <script src="{{asset("assets/$theme/plugins/select2/js/select2.full.min.js")}}"></script>

@endsection

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/galeria.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css') }}">
@endsection

@section('contenido')
    @include('includes.mensaje')

  @if ($contador <1 )
    @section('title')
      <h2>Sin servicios disponibles</h2>
    @endsection
  @else
  <div class="card card-solid">
    @section('title')
        <h2>Servicios disponibles</h2>
    @endsection
    <div class="card-body pb-0">
      <form action="{{route('home')}}" method="get" autocomplete="off">
        <div class="container" style="display:inline-flex; background:white;">
          {{-- <div class="form-group"> --}}
            <select name="category" class="form-control select2">
                <option value="">Seleccione la especialidad</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"{{ old('category', request()->input('category')) == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
          {{-- </div> --}}
            <div class="col-md-6" style="display:inline-flex; background:white;">
                <div class="input-group">
                  <input class="form-control form-group-sm" id="search_input" name="search" value="{{ old('search', request()->input('search')) }}" type="text" placeholder="Ubicación" aria-label="Ubicación" autocomplete="off" />                  
                </div>
                <div class="input-group">
                    <button type="submit" class="btn btn-default">
                        <span class="fas fa-search"></span>
                    </button>
                </div>
            </div> 
        </div>
    </form>
    <hr>


      <div class="row d-flex align-items-stretch">
        @foreach($profiles as $k => $profile)
          @if(implode(', ', $profile->especialidades()->get()->pluck('name')->toArray()) == null)

          @else
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  <a href="{{route('perfil', ['id' => $profile->user_id])}}" style="text-decoration:none;">
                    <b>{{$profile->user->name}}</b>
                  </a>
                  @guest
                      <a href="javascript:void(0);" onclick="toastr.info('Para agregar lista de favoritos primero debes iniciar sesión.','Info',{
                          closeButton: true,
                          progressBar: true,
                      })" class="btn btn-sm bg-teal" style="float: right;" style="float:right;">
                      <i class="far fa-bookmark" data-toggle="tooltip" data-placement="bottom" title="Agregar a favoritos"></i></a>
                  @else
                    @if(Auth::user()->id != $profile->user_id)
                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $profile->id }}').submit();"
                          class="btn btn-sm bg-teal {{ !Auth::user()->favorite_profiles->where('pivot.profile_id',$profile->id && 'pivot.user_id', auth()->user()->id)}}" style="float:right;">
                          {{-- @if( $fav->user_id == auth()->user()->id) --}}
                          {{-- @if(implode($profile->user->favorite_profiles()->get()->pluck('user_id', 'profile_id')->toArray()) != null) --}}
                            {{-- <i class="fas fa-bookmark" data-toggle="tooltip" data-placement="bottom" title="Remover de favoritos"></i> --}}
                          {{-- @else --}}
                            <i class="far fa-bookmark"></i>
                          {{-- @endif --}}
    
                          <form id="favorite-form-{{ $profile->id }}" method="post" action="{{ route('profile.favorite',$profile->id) }}" style="display: none;">
                            @csrf
                          </form>
                        </a>
                      @endif
                  @endguest
            
                
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">

                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-pencil-ruler"></i></span> <b>Especialidad: </b> 
                          {{ implode(', ', $profile->especialidades()->get()->pluck('name')->toArray()) }}
                        </li>
                      </ul>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-map-marker-alt mr-1"></i></span> <b> Localidad:</b> {{$profile->address_address}}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                        @if (empty($profile->avatar))
                            <img src="{{ asset('avatar/avatar.png')}}" class="profile-user-img img-fluid img-circle">
                        @else
                            <img src="{{ asset('uploads/profile_pictures')}}/{{$profile->avatar }}"  class="profile-user-img img-fluid img-circle">  
                        @endif
                    </div>
                  </div>
                </div>
                <div class="card-footer text-left">
                  @foreach($rating as $key => $value) 
                    @foreach($value as $r) 
                      @if($r->profile_id == $profile->id) 
                        @if($loop->last)
                          <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->avg_rating >= 1 ? ' blue' : ''}}"></i></li>
                          <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->avg_rating >= 2 ? ' blue' : ''}}"></i></li>
                          <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->avg_rating >= 3 ? ' blue' : ''}}"></i></li>
                          <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->avg_rating >= 4 ? ' blue' : ''}}"></i></li>
                          <li class="list-inline-item"><i class="fas fa-star fa-lg {{$r->avg_rating >= 5 ? ' blue' : ''}}"></i></li>  
                        @endif
                      @endif
                    @endforeach
                  @endforeach
                </div>
              </div>
            </div>
          @endif
        @endforeach
        
      </div>
    </div>
  </div>
  @endif

    
@endsection