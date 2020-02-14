<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Sobre Mi</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <strong><i class="fas fa-pencil-alt mr-1"></i> Especialidad</strong>

      <p class="text-muted">
        <span class="tag tag-danger">UI Design</span>
        <span class="tag tag-success">Coding</span>
        <span class="tag tag-info">Javascript</span>
        <span class="tag tag-warning">PHP</span>
        <span class="tag tag-primary">Node.js</span>
      </p>

      <hr>

      <strong><i class="fas fa-book mr-1"></i>Formación</strong>

      <p class="text-muted">
        B.S. in Computer Science from the University of Tennessee at Knoxville
      </p>

      <hr>

      <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong><br>

      {{-- si user_id == auth::user()- --}}
      @if (empty($perfil->address) && (Auth::user()->id == $user->id))
        <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Ubicación</small></a>
      @else
        <small class="text-muted">{{$perfil->address}}</small>
      @endif

      {{-- <p class="text-muted">{{$perfil->address ?? 'Agregar ubicacion'}}</p> --}}

      <hr>

      <strong><i class="far fa-file-alt mr-1"></i> Descripción</strong><br>

      @if (empty($perfil->description))
        <a href="{{route("editar_perfil", ['id' => Auth::user()->id])}}" class="ubicacion" style="text-decoration:none;"><small>Agregar Descripción</small></a>
      @else
        <small class="text-muted">{{$perfil->description}}</small>
      @endif
      {{-- <p class="text-muted">{{$perfil->description ?? 'Agregar breve descripción'}}</p> --}}
    </div>
    <!-- /.card-body -->
  </div>