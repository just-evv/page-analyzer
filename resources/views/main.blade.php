<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Analyzator</title>
</head>

<body class="min-vh-100 d-flex flex-column">

<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Analyzer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('index') }}">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('urls.all') }}">Added</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show container-fluid mb-0" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<main class="flex-grow-1">
    <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                    <h1 class="display-3">Website analyzer</h1>
                    <p class="lead">Validate website for seo</p>
                    <form action="{{ route('urls.store') }}" method="post" class="d-flex justify-content-center">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="url[name]" class="form-control form-control-lg" placeholder="https://www.example.com">
                        <button type="submit" class="btn btn-primary ml-3 px-5 text-uppercase">Check</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<footer class="border-top mt-5 footer mt-auto py-3">
    <div class="container-fluid">
        <div class="text-center">
            <a href="https://github.com/just-evv/php-project-lvl3" target="_blank">Analyzer</a>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
