<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Analyzator</title>
</head>
<body>

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

<div class="alert alert-primary" role="alert">
    The page successfully added!
</div>

<div class="container-md align-items-center">

<h1 class="display-4">Website: {{ $url->name }}</h1>

    <table class="table table-bordered table-hover my-3">
        <tr>
            <td>Id</td>
            <td>{{ $url->id }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $url->name }}</td>
        </tr>
        <tr>
            <td>Created at</td>
            <td>{{ $url->created_at }}</td>
        </tr>
    </table>

    <h2 class="display-4">Checks</h2>
    <button type="button" class="btn btn-primary my-3">Run check</button>
    <table class="table table-bordered table-hover my-3">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Response code</th>
            <th scope="col">h1</th>
            <th scope="col">Title description</th>
            <th scope="col">Created at</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>


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
