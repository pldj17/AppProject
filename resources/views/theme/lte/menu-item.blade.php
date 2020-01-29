@if ($item["submenu"] == [])
  <li class="{{getMenuActivo($item["url"])}}">
    <a href="{{url($item['url'])}}" class="nav-link">
      <i class="nav-icon fas {{$item["icon"]}}"></i> <span>{{$item["name"]}}</span>
    </a>
  </li>
@else
  <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas {{$item["icon"]}}"></i> <span>{{$item["name"]}}</span>
      <span class="pull-right-container">
        <i class="fas fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="nav nav-treeview">
      @foreach ($item["submenu"] as $submenu)
          @include("theme.$theme.menu-item", ["item" => $submenu])
      @endforeach
    </ul>
  </li>
@endif
