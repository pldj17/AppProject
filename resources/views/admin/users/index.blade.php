@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="class row justify-content-center">
            <div class="class col-md-12">
                <div class="class card">
                    <div class="class card-header">Roles de usuarios</div>
                    <div class="class card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->name}}</th>
                                    <th>{{ $user->email}}</th>                                    
                                    <th>{{ implode(',', $user->roles()->get()->pluck('name')->toArray())}}</th>   
                                    <th>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                            <button type="button" class="btn btn-primary btn-sm">Editar</button>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="sumit" class="btn btn-danger btn-sm">Eliminar</button>
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
    
@endsection