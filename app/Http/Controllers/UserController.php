<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', config('role.name.regular'))->get();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        return view('users.index');
    }

    public function edit()
    {
        return view('users.edit');
    }

    public function update()
    {
        return view('users.index');
    }
}
