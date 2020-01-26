@extends("theme.$theme.app")

@section('titulo')
    Menu-rol
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/menu-rol/index.js")}}" type="text/javascript"></script>
@endsection

@section('title')
    <h2>Menu por rol</h2>
@endsection

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card-header">
                    <div class="table-responsive">
                        @csrf
                        <table class="table table-striped table-bordered table-hover" id="tabla-data">
                            <thead>
                                <tr>
                                    <th>Menú</th>
                                    @foreach ($rols as $id => $name)
                                    <th class="text-center">{{$name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $key => $menu)
                                @if ($menu["menu_id"] != 0)
                                    @break
                                @endif
                                    <tr>
                                        <td class="font-weight-bold"><i class="fa fa-arrows-alt"></i> {{$menu["name"]}}</td>
                                        @foreach($rols as $id => $name)
                                            <td class="text-center">
                                                <input
                                                type="checkbox"
                                                class="menu_rol"
                                                name="menu_rol[]"
                                                data-menuid={{$menu[ "id"]}}
                                                value="{{$id}}" {{in_array($id, array_column($menusRols[$menu["id"]], "id"))? "checked" : ""}}>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach($menu["submenu"] as $key => $hijo)
                                        <tr>
                                            <td class="pl-20"><i class="fa fa-arrow-right"></i> {{ $hijo["name"] }}</td>
                                            @foreach($rols as $id => $name)
                                                <td class="text-center">
                                                    <input
                                                    type="checkbox"
                                                    class="menu_rol"
                                                    name="menu_rol[]"
                                                    data-menuid={{$hijo[ "id"]}}
                                                    value="{{$id}}" {{in_array($id, array_column($menusRols[$hijo["id"]], "id"))? "checked" : ""}}>
                                                </td>
                                            @endforeach
                                        </tr>
                                        @foreach ($hijo["submenu"] as $key => $hijo2)
                                            <tr>
                                                <td class="pl-30"><i class="fa fa-arrow-right"></i> {{$hijo2["name"]}}</td>
                                                @foreach($rols as $id => $name)
                                                    <td class="text-center">
                                                        <input
                                                        type="checkbox"
                                                        class="menu_rol"
                                                        name="menu_rol[]"
                                                        data-menuid={{$hijo2[ "id"]}}
                                                        value="{{$id}}" {{in_array($id, array_column($menusRols[$hijo2["id"]], "id"))? "checked" : ""}}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            @foreach ($hijo2["submenu"] as $key => $hijo3)
                                                <tr>
                                                    <td class="pl-40"><i class="fa fa-arrow-right"></i> {{$hijo3["name"]}}</td>
                                                    @foreach($rols as $id => $name)
                                                    <td class="text-center">
                                                        <input
                                                        type="checkbox"
                                                        class="menu_rol"
                                                        name="menu_rol[]"
                                                        data-menuid={{$hijo3[ "id"]}}
                                                        value="{{$id}}" {{in_array($id, array_column($menusRols[$hijo3["id"]], "id"))? "checked" : ""}}>
                                                    </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection