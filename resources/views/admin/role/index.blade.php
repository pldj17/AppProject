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
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary" style="float: right;">
                        Nuevo  
                        <i class="fas fa-plus"></i>
                    </a>
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
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection