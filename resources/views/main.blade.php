<!DOCTYPE html>
<html lang="en">
<head>
    <title>Analyzator</title>
</head>
<body>

<div class="container">
    <h2 class="text-center">Check url</h2>

    <form action="/url" method="post">
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
