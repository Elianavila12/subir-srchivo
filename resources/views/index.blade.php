@extends('principal')
@section('contenido')
@if(session('mensaje'))
<div class="container">
    <div class="alert alert-info" role="alert">
        {{session('mensaje')}}
    </div>
</div>
@endif
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 text-gray-800">Gestionar</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <form action="{{route('usuario.cargar')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @error('archivo')
                    <div class="red accent-3 white-text"> El archivo es obligatorio </div>
                    @enderror
                    <div class="form-group col-4">
                        <label for="archivo">Cargue su archivo CSV aqui!</label>
                        <input type="file" id="archivo" name="archivo">
                    </div>
                    <div class="form-group col-4">
                        <button class="btn btn-success" type="submit">Subir Archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
