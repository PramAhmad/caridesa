<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Support\Facades\Log;

class PermissionsTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = $this->getDefaultPermissions();
        $createdCount = 0;
        $skippedCount = 0;
        
        foreach ($permissions as $module => $modulePermissions) {
            foreach ($modulePermissions as $permission) {
                // Check if permission already exists
                $existingPermission = Permission::where('name', $permission['name'])
                    ->where('guard_name', 'web')
                    ->first();
                
                if ($existingPermission) {
                    // Permission exists, update module and description if needed
                    $existingPermission->update([
                        'module' => $module,
                        'description' => $permission['description'] ?? $existingPermission->description,
                    ]);
                    $skippedCount++;
                    $this->command->info("Permission '{$permission['name']}' already exists - updated module and description.");
                } else {
                    // Create new permission
                    Permission::create([
                        'name' => $permission['name'],
                        'module' => $module,
                        'description' => $permission['description'] ?? null,
                        'guard_name' => 'web',
                    ]);
                    $createdCount++;
                    $this->command->info("Permission '{$permission['name']}' created successfully.");
                }
            }
        }
        
        $this->command->info("Permissions processed: {$createdCount} created, {$skippedCount} skipped/updated.");

        // Create roles only if they don't exist
        $roles = [
            'superadmin' => [
                'description' => 'Super Administrator with full access',
                'permissions' => Permission::all(), // All permissions
            ],
            'admin' => [
                'description' => 'Administrator with most access except critical system settings',
                'permissions' => Permission::whereNotIn('name', [
                    'manage-system-settings',
                    'delete-roles'
                ])->get(),
            ],
            'manager' => [
                'description' => 'Manager with access to most features but limited administration',
                'permissions' => Permission::where('module', '!=', 'system')
                    ->whereNotIn('name', [
                        'delete-users',
                        'create-roles',
                        'update-roles',
                        'delete-roles',
                        'create-permissions',
                        'update-permissions',
                        'delete-permissions'
                    ])->get(),
            ],
            'user' => [
                'description' => 'Regular user with basic access',
                'permissions' => Permission::whereIn('name', [
                    'view-dashboard',
                    'update-profile',
                    'view-reports'
                ])->get(),
            ],
        ];

        foreach ($roles as $roleName => $roleData) {
            // Check if role already exists
            $existingRole = ModelsRole::where('name', $roleName)
                ->where('guard_name', 'web')
                ->first();
                
            if ($existingRole) {
                // Role exists, update description and permissions
                $existingRole->update([
                    'description' => $roleData['description'],
                ]);
                $existingRole->syncPermissions($roleData['permissions']);
                $this->command->info("Role '{$roleName}' already exists - updated description and permissions.");
            } else {
                // Create new role
                $role = ModelsRole::create([
                    'name' => $roleName,
                    'guard_name' => 'web',
                    'description' => $roleData['description'],
                ]);
                $role->syncPermissions($roleData['permissions']);
                $this->command->info("Role '{$roleName}' created successfully.");
            }
        }

        // Assign superadmin role to user ID 1 if it exists and doesn't have the role yet
        $admin = User::find(1);
        if ($admin) {
            if (!$admin->hasRole('superadmin')) {
                $admin->assignRole('superadmin');
                $this->command->info("Assigned 'superadmin' role to user ID 1.");
            } else {
                $this->command->info("User ID 1 already has 'superadmin' role.");
            }
        } else {
            $this->command->info("User ID 1 not found - no roles assigned.");
        }
    }

    /**
     * Get the default permissions organized by module
     */
    private function getDefaultPermissions(): array
    {
        return [
            'users' => [
                ['name' => 'view-users', 'description' => 'View the list of users'],
                ['name' => 'create-users', 'description' => 'Create new users'],
                ['name' => 'update-users', 'description' => 'Update existing users'],
                ['name' => 'delete-users', 'description' => 'Delete users'],
                ['name' => 'export-users', 'description' => 'Export users data'],
                ['name' => 'import-users', 'description' => 'Import users data'],
            ],
            'roles' => [
                ['name' => 'view-roles', 'description' => 'View the list of roles'],
                ['name' => 'create-roles', 'description' => 'Create new permissions'],
                ['name' => 'update-roles', 'description' => 'Update existing roles'],
                ['name' => 'delete-roles', 'description' => 'Delete roles'],
            ],
            'permissions' => [
                ['name' => 'view-permissions', 'description' => 'View the list of permissions'],
                ['name' => 'create-permissions', 'description' => 'Create new permissions'],
                ['name' => 'update-permissions', 'description' => 'Update existing permissions'],
                ['name' => 'delete-permissions', 'description' => 'Delete permissions'],
            ],
            'dashboard' => [
                ['name' => 'view-dashboard', 'description' => 'View the main dashboard'],
                ['name' => 'view-analytics', 'description' => 'View analytics and statistics'],
            ],
            'reports' => [
                ['name' => 'view-reports', 'description' => 'View all reports'],
                ['name' => 'export-reports', 'description' => 'Export reports data'],
                ['name' => 'generate-reports', 'description' => 'Generate new reports'],
            ],
            'system' => [
                ['name' => 'manage-system-settings', 'description' => 'Manage system configuration and settings'],
                ['name' => 'view-logs', 'description' => 'View system logs'],
                ['name' => 'manage-backups', 'description' => 'Manage system backups'],
            ],
            'profile' => [
                ['name' => 'update-profile', 'description' => 'Update own profile information'],
                ['name' => 'change-password', 'description' => 'Change own password'],
            ],
        ];
    }
}