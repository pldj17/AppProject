<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li> 
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    
    @if (auth()->user())

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown show-noti">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell fa-lg"></i>
          <small class="badge-warning navbar-badge number-alert">
          {{$numberAlert}}
        </small>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <small class="dropdown-item dropdown-header number-message">Tienes 
            {{$numberAlert}} 
            Notifications</small>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item comment-notification">
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer"><small>Ver todas las notificaciones</small></a>
        </div>
      </li>

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
