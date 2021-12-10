@extends('layouts.base')

@section('content')
    
<div class="container-lg align-items-center">

    <h1 class="my-3">Websites</h1>

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
                <td><a class="nav-link" href="{{ route('urls.show', ['id' => $url->id]) }}"> {{ $url->name }} </a></td>
                <td>{{ $url->last_check }}</td>
                <td>{{ $url->status_code }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $data->links('pagination::bootstrap-4') }}

</div>
    
@endsection

