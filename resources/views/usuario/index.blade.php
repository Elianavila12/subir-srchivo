@extends('principal')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col l6 m3 s12">
            <h4>
                Usuario
            </h4>
        </div>
        <br>
        <div class="col l6 m3 s12 text-right">
            <a href="{{route('usuario.crear')}}" class="btn btn-success">Agregar</a>
        </div>
    </div>
</div>
@if(session('mensaje'))
<div class="container">
    <div class="alert alert-info" role="alert">
        {{session('mensaje')}}
    </div>
</div>
@endif
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Peso</th>
                <th>Fecha de Nacimiento</th>
                <th>Fecha y Hora de Ingreso</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->nombre}}</td>
                <td>{{$usuario->cedula}}</td>
                <td>{{$usuario->peso}}</td>
                <td>{{$usuario->fecha_nacimiento}}</td>
                <td>{{$usuario->fecha_hora_ingreso}}</td>
                <td>{{$usuario->estado}}</td>
                <td>
                    <a href="{{route('usuario.csv', $usuario->id)}}" class="btn btn-info btn-small">
                        CSV
                    </a>
                    <a href="{{route('usuario.editar', $usuario)}}" class="btn btn-warning btn-small">
                        Editar
                    </a>
                    <form action="{{route('usuario.eliminar', $usuario)}}" class="input-field inline mt-2"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-small">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
