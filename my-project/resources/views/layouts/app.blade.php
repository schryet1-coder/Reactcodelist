<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="/">My App</a>
  </div>
</nav>
<div class="container">
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
