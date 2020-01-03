@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header1')   
{{-- <div class="container-fluid mt--7">
    <div class="container">
        <div class="class row justify-content-center">
            <div class="class col-md-12">
                <div class="class card">
                    <div class="class card-header">Roles de usuarios</div>
                    <div class="class card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th>{{ $role->name}}</th>              
                                    <th>
                                        <a href="#" class="float-left">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar"></i>
                                            </button>
                                        </a>
                                        <form action="#" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="sumit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt" data-toggle="tooltip" title="Eliminar"></i>
                                            </button>
                                        </form>
                                    </th>                                 
                                </tr>                                
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
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
                                    <input class="form-control" placeholder="Realizar búsqueda" type="text" name="buscarTexto" value="">
                                </div>
                            {{Form::close()}}
                        </div>

                        <div style="float:initial;">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#abrirmodal">
                                <i class="fa fa-plus fa"></i>&nbsp;&nbsp;Agregar Rol
                            </button>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="table-responsive">
                    <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>

                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <a href="#" class="float-left">
                                            <button type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">
                                                <i class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="sumit" class="btn btn-danger btn-sm" style="margin-left:5px;">
                                                <i class="fas fa-trash-alt" data-toggle="tooltip" title="Eliminar"></i>
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
        
                        </tbody>

                    </table>

                </div>

            </div>

            <div  style="margin-top:2%;">
                {{$roles->render()}}
            </div>
        </div>

        <!--Inicio del modal agregar-->

        <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar rol</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   
                    <div class="modal-body">
                         

                        <form action="{{route('admin.role.store')}}" method="post" class="form-horizontal">
                           
                            {{csrf_field()}}
                            
                            @include('admin.role.form')

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