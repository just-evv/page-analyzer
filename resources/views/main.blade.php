@extends('layouts.base')

@section('content')

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

                        <label for="url.name"></label>
                        <input type="text" name="url[name]" id="url.name" class="form-control form-control-lg" placeholder="https://www.example.com">
                        

                        <button type="submit" class="btn btn-primary ml-3 px-5 text-uppercase">Check</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection