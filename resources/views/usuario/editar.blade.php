@extends('principal')

@section('contenido')
<h4 class="text-center">Editar usuario {{$user->cedula}} - {{$user->nombre}}</h4><br>
@if(session('mensaje'))
<div class="container">
    <div class="alert alert-info" role="alert">
        {{session('mensaje')}}
    </div>
</div>
@endif
<div class="container">
    <div class="container">
        <form action="{{route('usuario.actualizar', $user)}}" method="POST">
            @method('PUT')
            @csrf
            @error('nombre')
            <div class="alert alert-danger" role="alert">
                El campo nombre es obligatorio
            </div>
            @enderror
            @error('cedula')
            <div class="alert alert-danger" role="alert">
                El campo cedula es obligatorio
            </div>
            @enderror
            @error('peso')
            <div class="alert alert-danger" role="alert">
                El campo peso es obligatorio
            </div>
            @enderror
            @error('estado')
            <div class="alert alert-danger" role="alert">
                El campo estado es obligatorio
            </div>
            @enderror
            @error('fecha_nacimiento')
            <div class="alert alert-danger" role="alert">
                El campo fecha de nacimiento es obligatorio
            </div>
            @enderror
            @error('fecha_hora_ingreso')
            <div class="alert alert-danger" role="alert">
                El campo fecha y hora de ingreso es obligatorio
            </div>
            @enderror
            <div class="form-group">
                <input type="text" placeholder="Cedula" name="cedula" value="{{$user->cedula}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Nombre" name="nombre" value="{{$user->nombre}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="number" placeholder="Peso" name="peso" value="{{$user->peso}}" class="form-control">
            </div>
            <div class="form-group">
                <select class="form-select" aria-label="Default select example" name="estado" value="{{old('estado')}}">
                    <option selected>Seleccione un estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div class="form-group">
                <input type="date" placeholder="Fecha de Nacimiento" name="fecha_nacimiento"
                    value="{{$user->fecha_nacimiento}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="datetime-local" placeholder="Fecha y Hora de Ingreso" name="fecha_hora_ingreso"
                    value="{{$user->fecha_hora_ingreso}}" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-warning" type="submit">Editar Usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection
