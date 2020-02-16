@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Especialidades
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/role/js.js")}}" type="text/javascript"></script>
@endsection

@section('title')
    <h2>Especialidades</h2>
@endsection

@section('contenido') 

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-header">
                @include('includes.form-error')
                @include('includes.mensaje')
                   
                    <div class="form-group row">
                        <div class="col-md-4">
                            {{ Form::open(['route' => 'rol', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
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
                        </div>
                    </div>
                    
                
                <div class="table-responsive">
                    <table id="tabla-data" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th class="width70">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>
                                    <a href="{{route('editar_especialidad', ['id' => $data->id])}}" class="btn-accion-tabla" data-toggle="tooltip" data-placement="bottom" title="Editar este registro">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{route('eliminar_especialidad', ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
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
            {{-- <div style="float:right; margin-top:1%;">
                {{$datas->render()}}
            </div> --}}
        </div>

        <!--Inicio del modal agregar-->

        <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalCenterTitle">Agregar Especialidad</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   
                    <div class="modal-body">
                         <form action="{{route('guardar_especialidad')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
                                    <div class="col-lg-12">
                                        <input type="text" name="name" id="name" class="form-control" value="" required/>
                                    </div>
                                </div>
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