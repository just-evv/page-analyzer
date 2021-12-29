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

        @foreach ($paginatedUrls as $url)
            <tr>
                <td>{{ $url->id }}</td>
                <td><a class="nav-link" href="{{ route('urls.show', ['url' => $url->id]) }}"> {{ $url->name }} </a></td>
                @if(array_key_exists($url->id, $lastChecks))
                    <td>{{ $lastChecks[$url->id]->created_at ?? '' }}</td>
                    <td>{{ $lastChecks[$url->id]->status_code ?? ''}}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $paginatedUrls->links('pagination::bootstrap-4') }}

</div>
    
@endsection

