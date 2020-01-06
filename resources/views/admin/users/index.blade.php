@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Usuarios
@endsection

@section('content')
    @include('users.partials.header1', [
        'title' => auth()->user()->name
    ])   
{{-- <div class="container-fluid mt--7">
    <div class="container">
        <div class="class row justify-content-center">
            <div class="class col-md-12">
                <div class="class card">
                    <div class="class card-header">Roles de usuarios</div>
                    <div class="class card-body">
                        <table class="table" style="width:80%;">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Creación</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->name}}</th>
                                    <th scope="row">{{ $user->email}}</th>                                    
                                    <th scope="row">{{ implode(',', $user->roles()->get()->pluck('name')->toArray())}}</th>   
                                    <th scope="row">{{date('d/m/Y', strtotime($user->created_at))}}</th>
                                    <th scope="row">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
                    <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <div class="class row justify-content-center">
                                            {{-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-link"><span class="fa fa-eye"></span></a>
                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-link"><span class="fa fa-pencil-alt"></span></a>
                                                <button type="submit" class="btn btn-link"><span class="fa fa-trash"></span></button>
                                            </form> --}}
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="float-left">
                                                <button type="button" class="btn btn-success btn-sm">
                                                    <i class="fas fa-eye" data-toggle="tooltip" title="Ver perfil"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                                <button type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">
                                                    <i class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="sumit" class="btn btn-danger btn-sm" style="margin-left:5px;">
                                                    <i class="fas fa-trash-alt" data-toggle="tooltip" title="Eliminar"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>

                    </table>
                </div>
                {{-- <div  style="margin-top:2%;">
                    {{$roles->render()}}
                </div> --}}
            </div>
        </div>

    </div>
</div>

    
@endsection