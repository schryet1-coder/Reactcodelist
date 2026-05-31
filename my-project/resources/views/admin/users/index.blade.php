@extends('layouts.app')

@section('content')
<h3>Admin - Users</h3>
<table class="table">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Admin</th></tr></thead>
    <tbody>
    @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->is_admin ? 'Yes' : 'No' }}</td>
            <td>
                <form method="post" action="/admin/users/{{ $u->id }}/toggle-admin" style="display:inline">@csrf<button class="btn btn-sm btn-secondary">Toggle Admin</button></form>
                <form method="post" action="/admin/users/{{ $u->id }}/delete" style="display:inline" onsubmit="return confirm('Delete user?')">@csrf<button class="btn btn-sm btn-danger">Delete</button></form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
