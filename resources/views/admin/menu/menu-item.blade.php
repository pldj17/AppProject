@if ($item["submenu"] == [])
<li class="dd-item dd3-item" data-id="{{$item["id"]}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content {{$item["url"] == "javascript:;" ? "font-weight-bold" : ""}}">
        <a href="{{route("editar_menu", ['id' => $item["id"]])}}">{{$item["name"]}} <i style="font-size:20px;" class="fa fa-fw {{isset($item["icon"]) ? $item["icon"] : ""}}"></i></a>
        <a href="{{route('eliminar_menu', ['id' => $item["id"]])}}" class="eliminar-menu" data-toggle="tooltip" data-placement="bottom" title="Eliminar este registro" style="float:right;"><i class="fa fa-fw fa-trash text-danger"></i></a>
    </div>
</li>
@else
<li class="dd-item dd3-item" data-id="{{$item["id"]}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content {{$item["url"] == "javascript:;" ? "font-weight-bold" : ""}}">
        <a href="{{route("editar_menu", ['id' => $item["id"]])}}">{{ $item["name"]}} <i style="font-size:20px;" class="fa fa-fw {{isset($item["icon"]) ? $item["icon"] : ""}}"></i></a>
        <a href="{{route('eliminar_menu', ['id' => $item["id"]])}}" class="eliminar-menu" data-toggle="tooltip" data-placement="bottom" title="Eliminar este registro" style="float:right;"><i class="fa fa-fw fa-trash text-danger"></i></a>
    </div>
    <ol class="dd-list">
        @foreach ($item["submenu"] as $submenu)
        @include("admin.menu.menu-item",[ "item" => $submenu ])
        @endforeach
    </ol>
</li>
@endif
