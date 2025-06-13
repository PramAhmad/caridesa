<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Define all permissions grouped by module
        $permissions = [
            // System Management
            'system' => [
                'manage-system-settings' => 'Manage system-wide settings and configurations',
                'view-logs' => 'View system logs and audit trails',
                'manage-backups' => 'Create, restore, and manage system backups',
            ],
            
            // User Management
            'users' => [
                'view-users' => 'View user list and profiles',
                'create-users' => 'Create new user accounts',
                'update-users' => 'Edit user information and settings',
                'delete-users' => 'Delete user accounts',
                'update-profile' => 'Update own profile information',
                'change-password' => 'Change own password',
            ],
            
            // Role Management
            'roles' => [
                'view-roles' => 'View roles and their permissions',
                'create-roles' => 'Create new roles',
                'update-roles' => 'Edit existing roles',
                'delete-roles' => 'Delete roles',
            ],
            
            // Permission Management
            'permissions' => [
                'view-permissions' => 'View available permissions',
                'create-permissions' => 'Create new permissions',
                'update-permissions' => 'Edit existing permissions',
                'delete-permissions' => 'Delete permissions',
            ],
            
            // Dashboard & Reports
            'dashboard' => [
                'view-dashboard' => 'Access main dashboard',
                'view-reports' => 'View system reports and analytics',
                'export-reports' => 'Export reports in various formats',
            ],
            
            // Theme Management
            'themes' => [
                'manage-themes' => 'Full theme management access',
                'view-themes' => 'View available themes and their settings',
                'create-themes' => 'Create new themes',
                'edit-themes' => 'Edit theme settings and configurations',
                'delete-themes' => 'Delete themes',
                'activate-themes' => 'Activate/deactivate themes',
                'edit-theme-content' => 'Edit theme content and sections',
                'upload-theme-assets' => 'Upload theme images and assets',
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create permissions
        foreach ($permissions as $module => $modulePermissions) {
            foreach ($modulePermissions as $name => $description) {
                $existingPermission = Permission::where('name', $name)->first();
                
                if ($existingPermission) {
                    // Update existing permission
                    $existingPermission->update([
                        'description' => $description,
                        'module' => $module,
                    ]);
                    $updatedCount++;
                } else {
                    // Create new permission
                    Permission::create([
                        'name' => $name,
                        'guard_name' => 'web',
                        'description' => $description,
                        'module' => $module,
                    ]);
                    $createdCount++;
                }
            }
        }
        
        $this->command->info("Permissions processed: {$createdCount} created, {$updatedCount} updated.");
    }
}