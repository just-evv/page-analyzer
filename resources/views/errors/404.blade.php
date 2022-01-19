@extends('layouts.base')

@section('content')


    <div class="container-lg align-items-center">
        <h1 class="my-3">{{ $exception->getMessage() }}</h1>
    </div>

@endsection

