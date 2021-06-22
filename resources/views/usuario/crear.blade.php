@extends('principal')

@section('contenido')
<h4 class="text-center">Agregar un producto</h4><br>
@if(session('mensaje'))
<div class="container">
    <div class="alert alert-info" role="alert">
        {{session('mensaje')}}
    </div>
</div>
@endif
<div class="container">
    <div class="container">
        <form action="{{route('usuario.guardar')}}" method="POST">
            @csrf
            @error('nombre')
            <div class="alert alert-danger" role="alert">
                El campo nombre es obligatorio
            </div>
            @enderror
            @error('cedula')
            <div class="alert alert-danger" role="alert" name="cedula">
                {{$message}}

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
                <input type="text" placeholder="Cedula" name="cedula" value="{{old('cedula')}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Nombre" name="nombre" value="{{old('nombre')}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="number" placeholder="Peso" name="peso" value="{{old('peso')}}" class="form-control">
            </div>
            <div class="form-group">
                <select class="form-control" name="estado" value="{{old('estado')}}">
                    <option selected>Seleccione un estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div class="form-group">
                <input type="date" placeholder="Fecha de Nacimiento" name="fecha_nacimiento"
                    value="{{old('fecha_nacimiento')}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="datetime-local" placeholder="Fecha y Hora de Ingreso" name="fecha_hora_ingreso"
                    value="{{old('fecha_hora_ingreso')}}" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Agregar Usuario</button>
            </div>
        </form>
    </div>
</div>
<script>
</script>
@endsection
