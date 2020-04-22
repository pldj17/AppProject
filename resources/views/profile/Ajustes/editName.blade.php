@extends("theme.$theme.app")

@section('titulo')
    Editar
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection    

@section('title')
    <h2>Editar Nombre</h2>
@endsection

@section('contenido')

@if(Auth::user()->id == $data->id)

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                   @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card-header">                         
                        <div class="class container" style="margin-top: 3%;">
                            <form action="{{route('upda_confName', ['id' => auth()->user()->id])}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                                @csrf @method("put")
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="name" id="name" class="form-control" value="" required/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="lastName" class="col-lg-3 control-label requerido">Apellido</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="lastName" id="lastName" class="form-control" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        <a href="{{route('config', ['id' => auth()->user()->id])}}" class="btn btn-secondary"> Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar</button>
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

@else
    <script>
        window.location.href = '{{ route('editar_config', [ Auth::user()->id]) }}';
    </script>
@endif

@endsection