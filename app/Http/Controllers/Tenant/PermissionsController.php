<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the permissions.
     */
    public function index()
    {
        // Group permissions by module
        $permissionsByModule = Permission::orderBy('module')->get()->groupBy('module');
        return view('tenant.permissions.index', compact('permissionsByModule'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        // Get unique modules for dropdown
        $modules = Permission::select('module')->distinct()->pluck('module')->filter();
        return view('tenant.permissions.create', compact('modules'));
    }

    /**
     * Store a newly created permission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'module' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Permission::create([
            'name' => $validated['name'],
            'module' => $validated['module'],
            'description' => $validated['description'] ?? null,
            'guard_name' => 'web',
        ]);

        return redirect()->route('tenant.permissions.index')
            ->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified permission.
     */
    public function show(Permission $permission)
    {
        return view('tenant.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission.
     */
    public function edit(Permission $permission)
    {
        // Get unique modules for dropdown
        $permissionsByModule = Permission::orderBy('module')->get()->groupBy('module');
        $modules = Permission::select('module')->distinct()->pluck('module')->filter();
        return view('tenant.permissions.edit', compact('permission', 'modules'));
    }

    /**
     * Update the specified permission.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,'.$permission->id,
            'module' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $permission->update([
            'name' => $validated['name'],
            'module' => $validated['module'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('tenant.permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified permission.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('tenant.permissions.index')
            ->with('success', 'Permission deleted successfully');
    }
}