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
                    <a class="nav-link active" href="/">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/urls">Added</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

@if ($errors->any())
    <div class="alert alert-danger container-fluid" role="alert">
        @include('flash::message')
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div class="container-fluid bg-dark text-white align-items-center">
    <div class="container-md p-5">
        <h1 class="display-1">Web-site analyzer</h1>

        <h2 class="display-7">Validate web-site for seo-readiness</h2>

        <form class="form-inline" action="/" method="post" >

        @csrf <!-- {{ csrf_field() }} -->
            <div class="form-row align-items-center">
                <div class="col-md-6 my-1">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input type="text"  class="form-control mb-3" id="inlineFormInput" required name="name" placeholder="http://example.com">
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary mb-2">Check url</button>
                </div>
            </div>
        </form>


    </div>


</div>

<footer class="footer mt-auto py-3">
    <div class="container-fluid">
        <div class="text-center">
            <a>Analyzer</a>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
