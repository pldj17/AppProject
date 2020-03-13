<div class="card card-primary card-outline">
    <div class="card-body box-profile">
    
      @include('includes.icon_editar_perfil')
        
      <div class="text-center">
        @if (empty($perfil->avatar))
            <img src="{{ asset('avatar/avatar.png')}}" class="profile-user-img img-fluid img-circle" style="height:130px; width:130px;">
        @else
            <img src="{{ asset('uploads/profile_pictures')}}/{{ $perfil->avatar }}" rel="ligthbox" class="profile-user-img img-fluid img-circle" style="width:130px; height:130px; borderdius:50%; margin-left: auto; margin-right: auto;">  
        @endif
      </div>

      <h3 class="profile-username text-center">{{$user->name}}</h3>

      

      @if ($perfil->private == 1 )
        @if(empty($perfil->address) && (Auth::user()->id == $user->id))
          <center><i class="fas fa-map-marker-alt mr-1"></i>
          <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Ubicación</small></a>
        @else
          <center><i class="fas fa-map-marker-alt mr-1"></i>
          <small class="text-muted">{{$perfil->address}}</small>
        @endif
      @endif
      <br><br></center>
          
      @if ($perfil->private == 1 )
        <a href="#" class="btn btn-primary btn-block"><b>Calificar</b></a>                   
      @endif
    </div>
</div>