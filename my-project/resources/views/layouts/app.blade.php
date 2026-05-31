<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CodeList Platform</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f7f9fb; }
        .hero-card { background: #fff; border-radius: 1.25rem; box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08); }
        .feature-badge { font-size: 0.78rem; letter-spacing: .06em; text-transform: uppercase; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">CodeList</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/channels">Channels</a></li>
                <li class="nav-item"><a class="nav-link" href="/matches">Matches</a></li>
                <li class="nav-item"><a class="nav-link" href="/reels">Reels</a></li>
                <li class="nav-item"><a class="nav-link" href="/subscriptions">Subscriptions</a></li>
                <li class="nav-item"><a class="nav-link" href="/ads">Ads</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="/dashboard" class="btn btn-outline-light btn-sm">My Account</a>
                    <form method="post" action="{{ url('/logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="/register" class="btn btn-primary btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<div class="container py-4">
    @if(session('message'))
        <div class="alert alert-success shadow-sm">{{ session('message') }}</div>
    @endif
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
