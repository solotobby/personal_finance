<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSetupController extends Controller
{
    public function create()
    {
        $admin = User::where('role', 'admin')->first();
        if($admin){
            return view('admin_created');
        }
        return view('admin_setup');
    }

    public function store(Request $request)
    {
        $admin = User::where('role', 'admin')->first();

        if($admin){
            return view('admin_created');
        }
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($request->password);

        $admin = User::create($data + ['role' => config('role.name.admin')]);
        if($admin){
            return view('admin_created');
        }
        return back()->with('error', 'Admin was not created');
    }
}
