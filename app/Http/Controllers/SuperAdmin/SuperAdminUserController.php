<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminUserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('super-admin.dashboard', compact('users'));
    }


    public function create()
    {
        $roles = Role::pluck('name');
        $permissions  = Permission::pluck('name');
        return view('super-admin.create', compact('roles', 'permissions'));
    }


    public function store(Request $request)
    {

        try {
            $validated = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required',
                'permissions' => 'required'
            ]);

            if ($validated->fails()) {
                return redirect()->back()->withErrors($validated);
            }


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->role);
            $user->givePermissionTo($request->permissions);

            return redirect()->route('super-admin-dashboard')->with('success', 'User Created ');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function edit(User $user)
    {
        
        $roles = Role::pluck('name', 'name');
        $permissions = Permission::pluck('name', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('super-admin.edit', compact('user', 'roles', 'permissions', 'userRole', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'permissions' => 'nullable|array',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);
        $user->syncPermissions($request->permissions ?? [   ]);

        return redirect()->route('super-admin-dashboard')->with('success', 'User updated successfully.');
    }
    
    public function delete($id){
        $user =User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('super-admin-dashboard')->with('success', 'User updated successfully.');

    }
}
