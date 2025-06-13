<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('tenant.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        // Group permissions by module
        $permissionsByModule = Permission::orderBy('module')->get()->groupBy('module');
        $permissions = Permission::all();
        
        return view('tenant.roles.create', compact('permissionsByModule', 'permissions'));
    }

    /**
     * Store a newly created role.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $validated['name']]);

        // Handle permissions from tagify input
        if (is_string($validated['permissions'])) {
            // Tagify sends JSON string
            $permissionsData = json_decode($validated['permissions'], true);
            $permissionNames = [];
            
            // Handle different possible structures from tagify
            if (is_array($permissionsData)) {
                foreach ($permissionsData as $permission) {
                    if (is_array($permission) && isset($permission['value'])) {
                        $permissionNames[] = $permission['value'];
                    } elseif (is_object($permission) && isset($permission->value)) {
                        $permissionNames[] = $permission->value;
                    } elseif (is_string($permission)) {
                        $permissionNames[] = $permission;
                    }
                }
            }
            
            if (!empty($permissionNames)) {
                $role->syncPermissions($permissionNames);
            }
        } else {
            // Standard array input (for backward compatibility)
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('tenant.roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        return view('tenant.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        // Group permissions by module
        $permissionsByModule = Permission::orderBy('module')->get()->groupBy('module');
        
        // Get current role permissions
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        
        return view('tenant.roles.edit', compact('role', 'permissionsByModule', 'rolePermissions'));
    }

    /**
     * Update the specified role.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);
        
        // Update role
        $role->update([
            'name' => $request->name,
        ]);
        
        // Sync permissions
        $role->syncPermissions($request->permissions ?? []);
        
        return redirect()->route('tenant.roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified role.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('tenant.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}