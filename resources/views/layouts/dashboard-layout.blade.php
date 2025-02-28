<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>@yield('title')</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-light bg-light">
        <div class="container d-flex justify-content-between">
            <span class="display-6">@yield('nav-brand')</span>
            <div>
                <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <input class="btn btn-danger" type="submit" value="LOGOUT">
                </form>
    
            </div>
        </div>
    </nav>
    <main class="flex-grow-1">
        @yield('main')

    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Dern-Support. All rights reserved.</p>
    </footer>
</body>
</html>