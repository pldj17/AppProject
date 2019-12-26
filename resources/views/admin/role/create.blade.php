@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header1', [
        'title' => auth()->user()->name
    ]) 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card">
                <h4 class="card-header">Nuevo rol</h4>
                <div class="card-body">
        {{-- 
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6>Por favor corrige los errores debajo:</h6>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <form method="POST" action="{{ url('roles') }}" autocomplete="off">
                        {{ csrf_field('INSERT') }}

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" name="name" id="name"  value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" class="form-control" name="description" id="description" value="{{ old('description') }}"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear rol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection