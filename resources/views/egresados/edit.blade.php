@extends('layouts.app')

@section('content')
    <h1>Editar Egresado</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('egresados.update', $egresado->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="{{ $egresado->nombre }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" value="{{ $egresado->apellido }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" value="{{ $egresado->cedula }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" value="{{ $egresado->celular }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" value="{{ $egresado->correo }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" value="{{ $egresado->ciudad }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
@endsection
