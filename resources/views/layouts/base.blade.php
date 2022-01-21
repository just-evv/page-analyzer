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

    <title> @yield('Analyzator')</title>
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.header')

<main class="flex-grow-1">
    
    @include('flash::message')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show container-fluid mb-0" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @yield('content')
    
</main>

@include('layouts.footer')

</body>
</html>