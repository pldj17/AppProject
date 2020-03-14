@extends("theme.$theme.app")



@section('contenido')
    @include('includes.mensaje')

  @if ($contador < 0 )
    @section('title')
      <h2>Sin servicios disponibles</h2>
    @endsection
  @else
  <div class="card card-solid">
    @section('title')
        <h2>Servicios disponibles</h2>
    @endsection
    <div class="card-body pb-0">
      <div class="row d-flex align-items-stretch">
        @foreach($profiles as $profile)
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">
                Digital Strategist
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">

                    <h2 class="lead"><b>{{$profile->user->name}}</b></h2>
                    
                    {{-- <p class="text-muted text-sm"><b>Especialidad: </b> {{ implode(', ', $profile->especialidades()->get()->pluck('name')->toArray())}} </p> --}}

                    <p class="text-muted text-sm"><b>Especialidad: </b> 
                      {{-- @foreach($users as $user)
                        @foreach($user->especialidades as $especialidad)
                          {{ $especialidad->id }}
                        @endforeach
                      @endforeach --}}
                      {{-- @foreach($users as $user) 
                        @foreach($user->especialidades as $category)
                        {{ $category->name }}
                        @endforeach
                      @endforeach --}}
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
                  {{-- <a href="#" class="btn btn-sm bg-teal">
                    <i class="fas fa-comments"></i>
                  </a> --}}
                  <a href="{{route('perfil', ['id' => $profile->user_id])}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Ver Perfil
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

    
@endsection
  