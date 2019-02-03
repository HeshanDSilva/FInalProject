<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WSTV</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    #bg
    {
          position: absolute;
          top: 25%;
          left: 0;
          right: 0;
          bottom: 25%;
          margin: auto;
          min-width: 50%;
          min-height: 50%;
      }


body{
    background-image: url("/bodybackgrounds/sky.jpg");
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

div {
    opacity: 0.92;
}
</style>
</head>
<body>
    <div id="app">
      <br><br><br><br>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
