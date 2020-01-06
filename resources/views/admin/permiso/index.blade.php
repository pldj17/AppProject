@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Permisos
@endsection

@section('content')
    @include('users.partials.header1')  

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                        <td></td>
                                    </tr>
                                @endforeach

                            </tbody>
    
                        </table>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    
        
    @endsection