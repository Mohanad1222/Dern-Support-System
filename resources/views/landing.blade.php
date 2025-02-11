<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Dern Support</title>
</head>

<body>
    @if (Auth::check())
        <p>Welcome, {{ Auth::user()->user_name }}! you are a/an {{Auth::user()->role}}</p>
        <form action="{{route('auth.logout')}}" method="post">
            @csrf
            <button type="submit">LOGOUT</button>
        </form>
    @else
        <p>You are not logged in.</p>
        <a href="{{ route('auth.login.form') }}">Login</a>
    @endif


</body>

</html>
