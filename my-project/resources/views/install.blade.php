@extends('layouts.app')

@section('content')
<h2>Installer</h2>
<form method="post" action="{{ url('/install') }}">
    @csrf
    <div class="mb-3">
        <label>DB Host</label>
        <input name="db_host" class="form-control" value="127.0.0.1" required>
    </div>
    <div class="mb-3">
        <label>DB Port</label>
        <input name="db_port" class="form-control" value="3306" required>
    </div>
    <div class="mb-3">
        <label>DB Name</label>
        <input name="db_database" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>DB User</label>
        <input name="db_username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>DB Password</label>
        <input name="db_password" class="form-control" type="password">
    </div>

    <h4>Admin</h4>
    <div class="mb-3"><label>Name</label><input name="admin_name" class="form-control" required></div>
    <div class="mb-3"><label>Email</label><input name="admin_email" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input name="admin_password" type="password" class="form-control" required></div>

    <button class="btn btn-primary">Install</button>
</form>

@if($errors->any())
    <div class="mt-3 alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
