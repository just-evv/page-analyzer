<!DOCTYPE html>
<html lang="en">
<head>
    <title>Analyzator</title>
</head>
<body>

    <h2 class="text-center">Urls list</h2>

    <table>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Created at</td>
        </tr>
        @foreach ($data as $url)
            <tr>
                <td>{{ $url->id }}</td>
                <td>{{ $url->name }}</td>
                <td>{{ $url->created_at }}</td>
            </tr>
        @endforeach

    </table>

</body>
</html>


