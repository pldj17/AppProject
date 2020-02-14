@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Usuarios
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
@endsection

@section('title')
    <h2>Usuarios</h2>
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('includes.form-error')
            @include('includes.mensaje')
            <div class="card-header">
                    <div class="form-group row">
                        <div class="col-md-6">
                            {{ Form::open(['route' => 'usuario', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
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
                    </div>
                <div class="table-responsive">
                    <table id="tabla-data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Registrado</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{ implode(',', $data->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>Activo</td>
                                    <td>
                                        <a href="{{route('ver_perfil', ['id' => $data->id   ])}}" class="btn-accion-tabla" data-toggle="tooltip" data-placement="top" title="Ver perfil de usuario">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{route('editar_usuario', ['id' => $data->id])}}" class="btn-accion-tabla" data-toggle="tooltip" data-placement="top" title="Editar rol de usuario">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{-- <form action="{{route('eliminar_usuario', ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
                                            @csrf @method("delete")
                                            <button type="submit" class="btn-accion-tabla eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar este registro">
                                                <i class="fa fa-fw fa-trash text-danger"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>

                    </table>
                </div>
            </div>
            <div  style="float:right; margin-top:1%;">
                {{$users->render()}}
            </div>
        </div>

    </div>
</div>

    
@endsection