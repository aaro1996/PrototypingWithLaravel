<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aaron Handles.men</title>
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
    <script defer="defer" src="{{elixir('js/app.js')}}"> </script>
    @yield('header')
</head>
<body>
    @include('layouts.laravel_header')
    <div class="container">
        @yield('content')
    </div>
</body>
@yield('js-footer')

</html>