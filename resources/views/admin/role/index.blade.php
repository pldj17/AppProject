@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Roles
@endsection

@section('content')
    @include('users.partials.header1')   

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/role/js.js")}}" type="text/javascript"></script>
@endsection

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card-header">
                    <h2>Roles</h2>
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!!Form::open(array('url'=>'role','method'=>'GET','autocomplete'=>'off','roles'=>'search'))!!} 
                                <div class="input-group">
                                    {{-- <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> --}}
                                    
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control form-control" placeholder="Realizar búsqueda" type="text" name="buscarTexto" value="">
                                </div>
                            {{Form::close()}}
                        </div>
                        <br><br>
                        <div style="margin-left: 15px;">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#abrirmodal">
                                <i class="fa fa-plus fa"></i>&nbsp;&nbsp;Nuevo registro
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="table-responsive">
                    <table id="tabla-data" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th class="width70">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>{{$role->description}}</td>
                                <td>
                                    <a href="{{route('editar_rol', ['id' => $role->id])}}" class="btn-accion-tabla" data-toggle="tooltip" data-placement="bottom" title="Editar este registro">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{route('eliminar_rol', ['id' => $role->id])}}" class="d-inline form-eliminar" method="POST">
                                        @csrf @method("delete")
                                        <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar este registro">
                                            <i class="fa fa-fw fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
    
                        </tbody>

                    </table>
                   
                </div>

            </div>
            <div style="float:right; margin-top:1%;">
                {{$roles->render()}}
            </div>
        </div>

        <!--Inicio del modal agregar-->

        <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalCenterTitle">Agregar Rol</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   
                    <div class="modal-body">
                         <form action="{{route('guardar_rol')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                            @csrf
                            <div class="box-body">
                                @include('admin.role.form')
                            </div>
                            <div class="box-footer">
                                    @include('includes.boton-form-crear')
                            </div>
                        </form>
                    </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->

    </div>
</div>
    
@endsection