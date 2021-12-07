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
                    <a class="nav-link active" href="{{ route('index') }}">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('urls.all') }}">Added</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


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

    <form method="post" action="{{ route('urls.checks', ['id' => $url->id ]) }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary my-3">Run check</button>
    </form>

    <table class="table table-bordered table-hover my-3">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Response code</th>
            <th scope="col">h1</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($checks as $check)
        <tr>
            <td>{{ $check->id }} </td>
            <td>{{ $check->status_code }} </td>
            <td><div class="d-inline-block  text-truncate" style="max-width: 150px;"> {{ $check->h1 }} </div></td>
            <td><div class="d-inline-block  text-truncate" style="max-width: 150px;"> {{ $check->title }} </div></td>
            <td><div class="d-inline-block  text-truncate" style="max-width: 150px;"> {{ $check->description }} </div></td>
            <td>{{ $check->created_at }} </td>
        </tr>
        @endforeach

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
