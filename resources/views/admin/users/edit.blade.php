@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="class row justify-content-center">
            <div class="class col-md-12">
                <div class="class card">
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
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection