@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Sistema de menus
@endsection  

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/menu/crear.js")}}" type="text/javascript"></script>
@endsection    

@section('title')
    <h2>Crear Menu</h2>
@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="card">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card-header">
                    
                    <div class="col-sm-8" style="margin-left:auto; margin-right:auto;">
                        <div class="card-body">
                            <form action="{{route('guardar_menu')}}" id="form-general" method="POST" autocomplete="off">
                                @csrf
                                <div class="box-body">
                                    @include('admin.menu.form')
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
            </div>
    
        </div>
    </div>    
        
    @endsection