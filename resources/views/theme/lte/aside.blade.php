<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route("home")}}" class="brand-link">
    <img src="{{asset("assets/$theme/dist/img/AdminLTELogo.png")}}"
         alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Project</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if (empty(Auth::user()->profile->avatar))
            <img src="{{ asset('avatar/avatar.png')}}" class="img-circle img-bordered-sm">
        @else
            <img src="{{ asset('uploads/profile_pictures')}}/{{ Auth::user()->profile->avatar }}" class="img-circle img-bordered-sm">  
        @endif
      </div>
      @auth()
      <div class="info"> 
        <a href="{{route('perfil', ['id' => Auth::user()->id])}}" class="d-block">{{auth()->user()->name}}</a>
      </div>
      @endauth
      @guest
      <div class="info">
        <a href="{{route('login')}}" class="d-block">Invitado</a>
      </div>
      @endguest
       
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{route("home")}}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Inicio</p>
          </a>
        </li>

       {{--  <li class="nav-item has-treeview">
          <a href="{{route("usuario")}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Usuario
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route("usuario")}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
              </a>
            </li>
          </ul>
        </li> --}}

        @foreach ($menusComposer as $key => $item)
            @if ($item["menu_id"] != 0)
                @break
            @endif
            @include("theme.$theme.menu-item", ["item" => $item])
        @endforeach
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
