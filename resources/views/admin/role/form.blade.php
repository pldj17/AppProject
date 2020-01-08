<div class="form-group">
    <label for="name" class="col-lg-3 control-label requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Nombre" required/>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-lg-3 control-label requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}" placeholder="Descripción" required/>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
    
</div>