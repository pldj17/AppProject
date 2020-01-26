<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a href="{{ route('profile.index') }}" class="nav-link mb-sm-3 mb-md-0 active"  aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-info-circle mr-2"></i>información</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('perfil_post') }}" class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" aria-selected="false"><i class="ni ni-image mr-2"></i>Fotos</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.contact') }}" class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fa fa-mobile mr-2"></i>Contacto</a>
        </li>
    </ul>
</div>