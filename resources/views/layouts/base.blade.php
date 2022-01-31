<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Analyzer</title>
</head>
<body class="d-flex flex-column min-vh-100"> 
    @include('layouts.header')
    <main class="flex-grow-1">
        
        @include('flash::message')
        @yield('content')
        
    </main>
    @include('layouts.footer')
</body>
</html>