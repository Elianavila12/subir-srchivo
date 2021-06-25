@extends('principal')
@section('contenido')
@isset($errores)
@foreach($errores as $error)
<div class="container">
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
</div>
@endforeach
@endisset
<div class="container">
    <div class="row">
        <div class="col-12 text-right">
            <a href="/download" class="btn btn-info"><i class="icon-download-alt"> </i>
                Descargar Log de Errores
            </a>
        </div>
    </div>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
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
