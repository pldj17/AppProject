<div class="form-group">
    <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
    <div class="col-lg-12">
        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $data->name ?? '')}}" required/>
    </div>
</div>