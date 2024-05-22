<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:user list'])->only(['index']);
        $this->middleware(['permission:user create'])->only(['create']);
        $this->middleware(['permission:user edit'])->only(['edit']);
        $this->middleware(['permission:user delete'])->only(['destroy']);
    }
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status,
        ]);

        $user->syncRoles($request->role_name);

        return back();
    }
}
