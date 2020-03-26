<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    {{-- <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route("home")}}" class="nav-link">Inicio</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contacto</a>
    </li> --}}
  </ul>

  <!-- SEARCH FORM -->
  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="¿Qué estás buscando?" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    
    <!-- Notifications Dropdown Menu -->
    @if (auth()->user())
      <li class="nav-item">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user">&nbsp;&nbsp;{{auth()->user()->name}}</i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" style="text-align:center;">
            Bienvenido!
          </span>
          <div class="dropdown-divider"></div>
            <a href="{{ route('perfil',['id' => Auth::user()->id] ) }}" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Perfil
            </a>
          <div class="dropdown-divider"></div>
            <a href="{{ route('config', [ Auth::user()->id]) }}" class="dropdown-item">
              <i class="fas fa-cog mr-2"></i> Configuración
            </a>
          
          <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i>Cerrar sesión
              </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer"></a>
        </div>
      </li>
    @else
      <div class="dropdown-divider"></div>
      @guest
      <a href="{{ route('login') }}" class="dropdown-item">
        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar sesión
      </a>
        @endguest
    @endif

    
  </ul>
</nav>
<!-- /.navbar -->
