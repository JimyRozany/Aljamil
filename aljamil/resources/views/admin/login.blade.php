<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <h1>admin login</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div style="border: 1px solid red">
                {{ $error }}
            </div>
        @endforeach

    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">login</button>
    </form>
</body>

</html>
