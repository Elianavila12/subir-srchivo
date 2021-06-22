@extends('principal')
@section('contenido')
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
