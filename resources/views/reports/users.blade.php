<!DOCTYPE html>
<html>
    <head>
        <title>Usuarios</title>
    </head>

    <style>
        #users {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #users td, #users th {
            border: 1px solid #ddd;
            padding: 5px;
        }
        #users tr:nth-child(even){background-color: #f2f2f2;}
        #users tr:hover {background-color: #ddd;}
        #users th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #3462ed;
            color: white;
        }
    </style>

<body>

    <h4>Reporte de usuarios &nbsp;&nbsp;&nbsp;&nbsp; Total de usuarios: &nbsp;&nbsp;{{$users->count()}} </h4>

    <div class="table-responsive" id="users">
    
        <table id="tabla-data" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Registrado</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Especialidad</th>
                <th>Posts</th>
            </tr>
            </thead>

            <tbody>
                @foreach($users as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{ implode(',', $data->roles()->get()->pluck('name')->toArray())}}</td>
                        <td>{{$data->created_at->format('Y-m-d')}}</td>
                        <td>
                            @if(implode(',', $data->profile()->get()->pluck('private')->toArray()) == '0' || implode(',', $data->profile()->get()->pluck('private')->toArray()) == '')
                                Privado
                            @else
                                Publico
                            @endif
                        </td>
                        <td>
                            @if($data->active == 1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                            {{ implode(', ',$data->profile->especialidades()->get()->pluck('name')->toArray())}}
                        </td>
                        <td>
                            {{$data->post()->count()}}
                        </td>
                    </tr>
                @endforeach
            
            </tbody>

        </table>
 
</body>
</html>