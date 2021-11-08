<!DOCTYPE html>
<html lang="en">
<head>
    <title>Analyzator</title>
</head>
<body>



<table>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>created_at</td>

    </tr>
    @foreach ($url as $item)

        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>

    @endforeach
</table>

</body>
</html>
