<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="practica de archivos con plantilla sb-admin">
    <meta name="author" content="Elian Avila">
    <title>Subir Archivos</title>
    <link href="{{asset('fonts/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('plantilla.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('plantilla.navbar')
                @yield('contenido')
                @include('plantilla.footer')
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>

</html>
