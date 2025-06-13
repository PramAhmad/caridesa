<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('tenant.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('tenant.users.create', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'nullable|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'] ?? null,
            'password' => Hash::make($validated['password']),
            'verified' => true,
            'email_verified_at' => now(),
        ]);

        // Handle roles from tagify input
        if (is_string($validated['roles'])) {
            // Tagify sends JSON string
            $rolesData = json_decode($validated['roles'], true);
            $roleNames = [];
            
            // Handle different possible structures from tagify
            if (is_array($rolesData)) {
                foreach ($rolesData as $role) {
                    if (is_array($role) && isset($role['value'])) {
                        $roleNames[] = $role['value'];
                    } elseif (is_object($role) && isset($role->value)) {
                        $roleNames[] = $role->value;
                    } elseif (is_string($role)) {
                        $roleNames[] = $role;
                    }
                }
            }
            
            if (!empty($roleNames)) {
                $user->assignRole($roleNames);
            }
        } else {
            // Standard array input (for backward compatibility)
            $user->assignRole($validated['roles']);
        }

        return redirect()->route('tenant.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('tenant.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('tenant.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        
        if (!empty($validated['username'])) {
            $userData['username'] = $validated['username'];
        }

        $user->update($userData);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Handle roles from tagify input
        if (is_string($validated['roles'])) {
            // Tagify sends JSON string
            $rolesData = json_decode($validated['roles'], true);
            $roleNames = [];
            
            // Handle different possible structures from tagify
            if (is_array($rolesData)) {
                foreach ($rolesData as $role) {
                    if (is_array($role) && isset($role['value'])) {
                        $roleNames[] = $role['value'];
                    } elseif (is_object($role) && isset($role->value)) {
                        $roleNames[] = $role->value;
                    } elseif (is_string($role)) {
                        $roleNames[] = $role;
                    }
                }
            }
            
            if (!empty($roleNames)) {
                $user->syncRoles($roleNames);
            }
        } else {
            // Standard array input (for backward compatibility)
            $user->syncRoles($validated['roles']);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}