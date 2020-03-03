<div class="card-header p-2">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('perfil',  ['id' => $user->id])}}">
            Mi información
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link " href="#">
              Favoritos
          </a>
      </li>
      {{-- <li class="nav-item">
          <a class="nav-link" href="#settings" data-toggle="tab">
              Contactos
          </a>
      </li> --}}
    </ul>
</div>