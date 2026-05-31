<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();
        return redirect('/admin/users')->with('message', 'User admin status toggled');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('message', 'User deleted');
    }
}
