@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Menu-rol
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/permiso-rol/index.js")}}" type="text/javascript"></script>
@endsection

@section('title')
    <h2>Permiso</h2>
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('includes.form-error')
            @include('includes.mensaje')
            <div class="card-header">
                <div class="table-responsive">
                    @csrf
                    <table class="table table-striped table-bordered table-hover" id="tabla-data">
                        <thead>
                            <tr>
                                <th>Permiso</th>
                                @foreach ($rols as $id => $name)
                                <th class="text-center">{{$name}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $key => $permiso)
                                <tr>
                                    <td class="font-weight-bold">{{$permiso["name"]}}</td>
                                    @foreach($rols as $id => $name)
                                        <td class="text-center">
                                            <input
                                            type="checkbox"
                                            class="permiso_rol"
                                            name="permiso_rol[]"
                                            data-permisoid={{$permiso[ "id"]}}
                                            value="{{$id}}" {{in_array($id, array_column($permisosRols[$permiso["id"]], "id"))? "checked" : ""}}>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

    
@endsection