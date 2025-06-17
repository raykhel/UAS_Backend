<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">E-Commerce</a>
            <div class="d-flex">
                @auth
                    <span class="navbar-text text-white me-3">Hai, {{ auth()->user()->name }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="/register" class="btn btn-outline-light btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>