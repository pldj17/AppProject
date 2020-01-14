@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Permiso - rol
@endsection

@section('content')
    @include('users.partials.header1')   

@section('script')
    <script src="{{asset("assets/pages/scripts/admin/permiso-rol/index.js")}}" type="text/javascript"></script>
@endsection

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('includes.form-error')
            @include('includes.mensaje')
            <div class="card">
                <div class="card-header">
                    <h2>Permisos</h2>
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!!Form::open(array('url'=>'role','method'=>'GET','autocomplete'=>'off','roles'=>'search'))!!} 
                                <div class="input-group">
                                   
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Realizar búsqueda" type="text" name="buscarTexto" value="">
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
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
            {{-- <div  style="float:right; margin-top:1%;">
                {{$users->render()}}
            </div> --}}
        </div>

    </div>
</div>

    
@endsection