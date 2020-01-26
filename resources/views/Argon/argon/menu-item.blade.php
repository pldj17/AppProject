@if ($item["submenu"] == [])
    <li class="{{getMenuActivo($item["url"])}}">
        <a class="nav-link" href="{{url($item['url'])}}">
          <i class="fa {{$item["icon"]}} text-primary"></i> <span>{{$item["name"]}}</span>
        </a>
    </li>
@else
    <li >
        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
          <i class="fa {{$item["icon"]}}" style="color: #f4645f;"></i> <span>{{$item["name"]}}</span>
        </a>
        <div class="collapse show" id="navbar-examples">
            <ul class="nav nav-sm flex-column">
                @foreach ($item["submenu"] as $submenu)
                    @include("theme.$theme.menu-item", ["item" => $submenu])
                @endforeach
            </ul>
        </div>
    </li>
@endif