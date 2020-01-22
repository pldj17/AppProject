@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Permisos
@endsection

@section('content')
    @include('users.partials.header1')  

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/permiso/crear.js")}}" type="text/javascript"></script>
@endsection

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card-header">
                        <h2>Permisos</h2>
                        <div class="form-group row">
                            <div class="col-md-4">
                                {{ Form::open(['route' => 'permiso', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                    <div class="form-group">
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Realizar búsqueda', 'autocomplete' => 'off']) }}
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default">
                                            <span class="fas fa-search"></span>
                                        </button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <div style="margin-left: 15px;">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#abrirmodal">
                                    <i class="fa fa-plus fa"></i>&nbsp;&nbsp;Nuevo registro
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabla-data"" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Slug</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
    
                            <tbody>                                
                            
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td>{{$permiso->id}}</td>
                                        <td>{{$permiso->name}}</td>
                                        <td>{{$permiso->slug}}</td>
                                        <td>
                                            <a href="{{route("editar_permiso", ['id' => $permiso->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{route("eliminar_permiso",  ['id' => $permiso->id])}}" class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro"><i class="fa fa-times-circle text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
    
                        </table>
                    </div>
                </div>
                <div style="float:right; margin-top:1%;">
                    {{$permisos->render()}}
                </div>
            </div>
    

            <!--Inicio del modal agregar-->

        <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalCenterTitle">Agregar Permiso</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   
                    <div class="modal-body">
                         <form action="{{route('guardar_permiso')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                            @csrf
                            <div class="box-body">
                                @include('admin.permiso.form')
                            </div>
                            <div class="box-footer" >
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