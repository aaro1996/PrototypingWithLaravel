<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aaron Handles.men</title>
        <link rel="stylesheet" href="{{elixir('css/app.css')}}">
        <script defer="defer" src="{{elixir('js/app.js')}}"> </script>
        @yield('header')
    </head>
    <body>
    <div id="app">
        <div class="container">
            @yield('content')
        </div>

        @yield('js-footer')
    </div>
    </body>
</html>