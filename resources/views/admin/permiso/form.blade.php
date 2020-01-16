<div class="form-group">
    <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
    <div class="col-lg-12">
    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $data->name ?? '')}}" required/>
    </div>
</div>
<div class="form-group">
    <label for="slug" class="col-lg-3 control-label requerido">slug</label>
    <div class="col-lg-12">
    <input type="text" name="slug" id="slug" class="form-control" value="{{old('slug', $data->slug ?? '')}}" required/>
    </div>
</div>