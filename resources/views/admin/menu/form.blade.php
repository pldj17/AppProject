<div class="form-group row">
    <label for="name" class="col-lg-2 col-form-label form-control-label requerido">Nombre</label>
    <div class="col-md-8">
        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $data->name ?? '')}}" required/>
    </div>
</div>

<div class="form-group row">
        <label for="url" class="col-md-2 col-form-label form-control-label requerido">Url</label>
    <div class="col-md-8">
        <input type="text" name="url" id="url" class="form-control" value="{{old('url', $data->url ?? '')}}" required/>
    </div>
</div>

<div class="form-group row">
    <label for="icon" class="col-md-2 col-form-label form-control-label">Icono</label>
    <div class="col-md-8">
        <input type="text" name="icon" id="icon" class="form-control" value="{{old('icon', $data->icon ?? '')}}"/>
    </div>
    <div class="col-lg-1" style="margin-top:1%;">
        <span id="mostrar-icono" class="fa fa-fw {{old("icon")}}"></span>
    </div>
</div>
