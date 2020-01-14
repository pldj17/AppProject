<div class="form-group">
    <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $data->name ?? '')}}" required/>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-lg-3 control-label">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="description" id="description" class="form-control" value="{{old('description', $data->description ?? '')}}"/>
    </div>
</div>
