@extends("theme.$theme.app", ['title' => __('User Profile')])

@section('titulo')
    Usuarios - roles
@endsection

@section('title')
    <h2>Rol {{$user->name}}</h2>
@endsection

@section('contenido')   

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card-header">
                        <div class="class card-body">
                            <form action="{{ route('actualizar_usuario', ['user'=>$user->id]) }}" method="POST">
                                @csrf @method("put")
                                @foreach ($roles as $role)
                                    <div class="class form-check">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                            {{ $user->hasAnyRole($role->name)?'checked':'' }}>
                                        <label>{{ $role->name}}</label>
                                    </div>
                                @endforeach
                                <div class="box-footer">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        @include('admin.users.boton-form-editar')
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