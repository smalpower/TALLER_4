@extends('adminlte::page')

@section('title', 'Usuarios y Roles')

@section('content_header')
    <h1 class="text-center">Gestión de Roles de Usuarios</h1>
@stop

@section('content')

    <!-- Redirigir a login si el usuario no está autenticado -->
    @if (!auth()->check())
        <script>
            window.location = "{{ route('login') }}"; // Cambia 'login' por el nombre de tu ruta de inicio de sesión
        </script>
    @endif

    <!-- Mensajes de éxito y error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Tarjeta contenedora -->
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Lista de Usuarios</h3>
            <div class="card-tools">
                <button class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- Tabla de usuarios -->
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol Actual</th>
                        @if(auth()->user()->hasRole('administrador'))
                            <th>Asignar Rol</th>
                            <th>Eliminar Rol</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->roles->isNotEmpty() ? $user->roles->pluck('name')->implode(', ') : 'Sin rol asignado' }}
                            </td>
                            @if(auth()->user()->hasRole('administrador'))
                                <td>
                                    @if ($firstAdmin && $firstAdmin->id === $user->id)
                                        <span class="text-muted">Administrador principal</span>
                                    @else
                                        <!-- Formulario para asignar roles -->
                                        <form action="{{ route('users.assignRole', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <select name="role_id" required class="form-control">
                                                    <option value="">Seleccionar rol</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                                </span>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if ($firstAdmin && $firstAdmin->id === $user->id)
                                        <span class="text-muted">No se puede eliminar</span>
                                    @else
                                        <!-- Formulario para eliminar roles -->
                                        <form action="{{ route('users.removeRole', ['user' => $user->id, 'role' => $role->name]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="input-group">
                                                <select name="role_id" required class="form-control">
                                                    <option value="">Seleccionar rol</option>
                                                    @foreach($user->roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </span>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@section('css')
    <style>
        .card {
            border-radius: 10px;
        }
        .table {
            margin-bottom: 0;
        }
        .thead-dark th {
            background-color: #343a40;
            color: #fff;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
