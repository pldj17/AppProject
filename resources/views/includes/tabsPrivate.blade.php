<div class="card-header p-2">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('perfil',  ['id' => $user->id])}}">
            Mi información
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link " href="{{route('mostrar_fav', $id = auth()->user()->id)}}">
              Favoritos
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">
            <i class="far fa-question-circle"  style="margin-top:40%" data-toggle="tooltip" data-placement="bottom" title="Acerca de..."></i>
        </a>
      </li>
      {{-- <li class="nav-item" >
          <a class="nav-link" href="#settings" data-toggle="tab"  style="float:right;">
            <i class="far fa-question-circle"  style="margin-top:40%" data-toggle="tooltip" data-placement="bottom" title="Acerca de..."></i>
          </a>
      </li> --}}
    </ul>
</div>