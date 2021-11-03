<!DOCTYPE html>
<html lang="en">
<head>
    <title>Analyzator</title>
</head>
<body>

<div class="container">
    <h2 class="text-center">Check url</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        <div>
            <label>
                url
                <input type="text" required name="name" >
            </label>
        </div>
        <input type="submit" value="Check">
    </form>
</div>

</body>
</html>
