@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Sistema de menus
@endsection

@section('content')
    @include('users.partials.header1') 
    
@section("styles")
    <link href="{{asset("assets/js/jquery-nestable/jquery.nestable.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section("scriptsPlugins")
    <script src="{{asset("assets/js/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/menu/index.js")}}" type="text/javascript"></script>
@endsection

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="container" >
                        <div class="card-header">
                            <h2>Menús</h2>
                            <div >
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#abrirmodal">
                                    <i class="fa fa-plus fa"></i>&nbsp;&nbsp;Agregar Rol
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            @csrf
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @foreach ($menus as $key => $item)
                                        @if ($item["menu_id"] != 0)
                                            @break
                                        @endif
                                        @include("admin.menu.menu-item",["item" => $item])
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
             <!--Inicio del modal agregar-->

        <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalCenterTitle">Agregar menu</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   
                    <div class="modal-body">
                        <form action="{{route('guardar_menu')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                            @csrf
                            <div class="box-body">
                                @include('admin.menu.form')
                            </div>
                            <div class="box-footer">
                                @include('includes.boton-form-crear')
                            </div>
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