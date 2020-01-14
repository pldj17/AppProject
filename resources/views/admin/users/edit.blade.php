@extends('layouts.app', ['title' => __('User Profile')])

@section('titulo')
    Usuarios - roles
@endsection

@section('content')
    @include('users.partials.header1')   

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card-header">
                        <div class="class card-header">Rol {{$user->name}}</div>

                        <div class="class card-body">
                            <form action="{{ route('admin.users.update', ['user'=>$user->id]) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
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