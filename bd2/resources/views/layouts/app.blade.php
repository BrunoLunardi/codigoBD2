<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E.A.L.T') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <style>
    #nav {
      background-image: url('{{asset('img/navbar.png')}}');
      background-repeat:repeat;
    }
       </style>



</head>
<body>
    <div id="app">
        <nav id="nav" class="navbar navbar-default navbar-static-top">
            <div class="container" >
                <div class="navbar-header" >


<a  href="{{ url('/') }}"><h1>COM231 - SISTEMA DE CONSULTA INDICATIVOS SOCIAIS</h1></a>
<br>
<br>
                    <!-- Collapsed Hamburger -->

                    <!-- Branding Image -->
                </div>


            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
