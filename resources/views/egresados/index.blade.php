@extends('layouts.app')

@section('content')
    <h1>Lista de Egresados</h1>

    @if (auth()->user()->can('agregar egresados'))
        <a href="{{ route('egresados.create') }}" class="btn btn-success">Crear Nuevo Egresado</a>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($egresados as $egresado)
                <tr>
                    <td>{{ $egresado->nombre }}</td>
                    <td>{{ $egresado->apellido }}</td>
                    <td>{{ $egresado->cedula }}</td>
                    <td>{{ $egresado->celular }}</td>
                    <td>{{ $egresado->correo }}</td>
                    <td>{{ $egresado->ciudad }}</td>
                    <td>
                        @if (auth()->user()->can('editar egresados'))
                            <a href="{{ route('egresados.edit', $egresado->id) }}" class="btn btn-warning">Editar</a>
                        @endif
                        @if (auth()->user()->can('eliminar egresados'))
                            <form action="{{ route('egresados.destroy', $egresado->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
