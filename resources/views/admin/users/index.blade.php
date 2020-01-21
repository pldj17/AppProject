@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Usuarios
@endsection

@section('content')
    @include('users.partials.header1')   

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
@endsection

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('includes.form-error')
            @include('includes.mensaje')
            <div class="card">
                <div class="card-header">
                    <h2>Usuarios</h2>
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
                    <table id="tabla-data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Registrado</th>
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
                                    <td>
                                        <a href="{{route('editar_usuario', ['id' => $data->id])}}" class="btn-accion-tabla" data-toggle="tooltip" data-placement="bottom" title="Editar rol de usuario">
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
            {{-- <div  style="float:right; margin-top:1%;">
                {{$users->render()}}
            </div> --}}
        </div>

    </div>
</div>

    
@endsection