<div class="form-group row">
    <label for="name" class="col-lg-2 col-form-label form-control-label requerido">Nombre</label>
    <div class="col-md-9">
        <input class="form-control" type="text" value="{{old('name')}}" placeholder="Nombre" id="name" name="name" required/>
    </div>
</div>

<div class="form-group row">
        <label for="url" class="col-md-2 col-form-label form-control-label requerido">Url</label>
    <div class="col-md-9">
        <input class="form-control" type="text" value="{{old('url')}}" placeholder="Url" id="url" name="url" required/>
    </div>
</div>

<div class="form-group row">
    <label for="icon" class="col-md-2 col-form-label form-control-label">Icono</label>
    <div class="col-md-9">
        <input class="form-control" type="text" value="{{old('icon')}}" placeholder="Icono" id="icon" id="icon" name="icon" >
    </div>
    <div class="col-lg-1">
        <span id="mostrar-icono" class="fa fa-fw {{old("icon")}}"></span>
    </div>
</div>
