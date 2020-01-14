@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Editar permiso
@endsection

@section('content')
    @include('users.partials.header1')   

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection    

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                   @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card-header">
                        <h2>Editar permiso</h2>    
                        
                        <div class="class container" style="margin-top: 3%;">
                            <form action="{{route('actualizar_permiso', ['id' => $data->id])}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                                @csrf @method("put")
                                <div class="box-body">
                                    @include('admin.permiso.form')
                                </div>
                                <div class="box-footer">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        @include('admin.permiso.boton-form-editar')
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection