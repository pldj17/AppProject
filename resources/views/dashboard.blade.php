@extends("theme.$theme.app")

@section('titulo')
    Inicio
@endsection

@section('contenido')
    @include('includes.mensaje')

  <div class="card card-solid">
    
    <div class="card-body pb-0">
      <div class="row d-flex align-items-stretch">
        @foreach($profiles as $profile)
          @if(implode(', ', $profile->user->especialidades()->get()->pluck('id')->toArray()) != null)
            @section('title')
              <h2>Servicios disponibles</h2>
            @endsection
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Digital Strategist
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">

                      <h2 class="lead"><b>{{$profile->user->name}}</b></h2>
                      
                      <p class="text-muted text-sm"><b>Especialidad: </b> 
                          {{ implode(', ', $profile->user->especialidades()->get()->pluck('name')->toArray()) }}
                      </p>
                      {{-- <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$profile->address}}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono: {{$profile->phone}}</li>
                      </ul> --}}
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
                <div class="card-footer">
                  <div class="text-right">

                      @guest
                          <a href="javascript:void(0);" onclick="toastr.info('Para agregar lista de favoritos primero debes iniciar sesión.','Info',{
                              closeButton: true,
                              progressBar: true,
                          })" class="btn btn-sm bg-teal"><i class="far fa-bookmark" data-toggle="tooltip" data-placement="bottom" title="Agregar a favoritos"></i>
                      @else
                        @if(Auth::user()->id != $profile->user_id)
                          <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $profile->id }}').submit();"
                            class="btn btn-sm bg-teal">
                              <i class="far fa-bookmark">
                              </i>
      
                            <form id="favorite-form-{{ $profile->id }}" method="post" action="{{ route('profile.favorite',$profile->id) }}" style="display: none;">
                              @csrf
                            </form>
                          </a>
                        @endif
                      @endguest
                
                    <a href="{{route('perfil', ['id' => $profile->user_id])}}" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> Ver Perfil
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @else
            @if ($loop->first)
              <h2>Sin servicios disponibles</h2>
            @endif
          @endif
        @endforeach
      </div>
    </div>
  </div>

    
@endsection
  