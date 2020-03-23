@extends("theme.$theme.app")

@section('titulo')
    Favoritos
@endsection

@section('scripts')

@endsection

@section('styles')

@endsection

@section('title')
    <h2>Favoritos</h2>
@endsection

@section('contenido')
    <div class="container-fluid">
    @include('includes.form-error')
    @include('includes.mensaje')

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Perfiles guardados</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
            </div>
            <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Nombres
                        </th>
                        <th style="width: 30%">
                            Avatar
                        </th>
                        <th>
                            Especialidad
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($perfil as $key=>$p)
                    
                    
                            <tr>
                                <td>
                                #
                                </td>
                                <td>
                                    <a>
                                        {{ $p->user->name }}
                                    </a>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            @if (empty($p->avatar))
                                                <img alt="Avatar" class="table-avatar" src="{{ asset('avatar/avatar.png')}}">
                                            @else
                                                <img alt="Avatar" class="table-avatar" src="{{ asset('uploads/profile_pictures')}}/{{$p->avatar }}" >  
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                                <td class="project_progress">
                                    @foreach($especialidad as $e)
                                        @if($e->id == $p->user_id)
                                            <small>
                                                {{ implode(', ', $e->especialidades()->get()->pluck('name')->toArray()) }}
                                            </small>
                                        @endif
                                    @endforeach  
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{route('perfil', ['id' => $p->user_id])}}">
                                        <i class="fas fa-user">
                                        </i>
                                        Ver perfil
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $p->id }}').submit();">
                                        <i class="fas fa-trash">
                                        </i>
                                        Remover de favoritos
                                    </a>
                                    <form id="favorite-form-{{ $p->id }}" method="post" action="{{ route('profile.favorite',$p->id) }}" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr> 
                        
                    @endforeach   
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>

@endsection