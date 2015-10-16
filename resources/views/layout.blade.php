<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href="favicon.ico">

    <title>@yield('title', 'Sistema') | Agence</title>


    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>

    
  </head>

<body>
    
    @include ('header') 

    <div class="container">
        @yield('content')
    </div>
    
    @include ('footer') 

    <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>