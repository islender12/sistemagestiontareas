<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>Laravel</title>
</head>

<body class="bg-slate-200">
    @yield('container')
    @vite('resources/js/sweetalert2.js')
    @vite('resources/js/app.js')
    <script>

    </script>
</body>

</html>
