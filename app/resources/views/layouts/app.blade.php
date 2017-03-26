<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portrait-radio') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans|Roboto" rel="stylesheet">
    <script src="https://use.fontawesome.com/5dde311f05.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="https://services.radio-canada.ca/media/player/client/radiocanadaca_premiere"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
