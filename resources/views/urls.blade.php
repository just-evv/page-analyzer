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
                    <a class="nav-link" href="/">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/urls">Added</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container-md align-items-center">

    <h1 class="mt-5 mb-3">Websites</h1>

    <table class="table table-bordered table-hover my-3">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Last check</th>
            <th scope="col">Response code</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($data as $url)
            <tr>
                <td>{{ $url->id }}</td>
                <td><a class="nav-link" href="/urls/{{ $url->id }}"> {{ $url->name }} </a></td>
                <td>{{ $url->last_check }}</td>
                <td></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $data->links('pagination::bootstrap-4') }}

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


