<div class="card-header p-2">
    <ul class="nav nav-pills" id="ul-tab">
      <li class="nav-item">
        <a class="nav-link active" id="li-act" href="{{route('perfil',  ['id' => $user->id])}}">
            Actividades
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link " id="li-img" href="{{route("perfil_post", ['id' => $user->id])}}">
              Fotos
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="li-cont" href="{{route('perfil_contact', ['id' => $user->id])}}">
              Contactos
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="li-pun" href="{{route('rating', ['id' => $user->id])}}">
            Puntuaciones
        </a>
    </li>
    </ul>
</div>