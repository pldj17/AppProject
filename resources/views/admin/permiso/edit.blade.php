@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Editar permiso
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection    

@section('title')
    <h2>Editar Permiso</h2>
@endsection

@section('contenido')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                   @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card-header">
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