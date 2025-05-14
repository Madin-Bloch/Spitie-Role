<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{

    public function index(){
        $roles = auth()->user()->getRoleNames(); 
        $permissions = auth()->user()->getAllPermissions();
        return view('admin.dashboard', compact('permissions','roles'));
    }

    public function create(){
        return view('super-admin.create');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:Admin,User',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);
            // dd('test');
        return redirect()->route('admin-dashboard')->with('success', 'User Created ');
    }
}
