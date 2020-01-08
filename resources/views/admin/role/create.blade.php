@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Roles
@endsection

@section('content')
    @include('users.partials.header1', [
        'title' => auth()->user()->name
    ]) 
<div class="container">
    <div class="row justify-content-center">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Crear Rol</h3>
                <div class="box-tools pull-right">
                    <a href="{{route('rol')}}" class="btn btn-block btn-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado
                    </a>
                </div>
            </div>
            <form action="{{route('guardar_rol')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                @csrf
                <div class="box-body">
                    @include('admin.role.form')
                </div>
                <div class="box-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @include('includes.boton-form-crear')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection