<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesTenantTableSeeder extends Seeder
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
        
        // Create default roles
        $roles = [
            [
                'name' => 'superadmin',
                'guard_name' => 'web',
                'description' => 'Super Admin role with full access to all features and functionality.',
                'permissions' => Permission::all()->pluck('name')->toArray(),
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'description' => 'Administrator role with access to most features except critical system settings.',
                'permissions' => Permission::whereNotIn('name', [
                    'manage-system-settings',
                    'delete-roles',
                ])->pluck('name')->toArray(),
            ],
            [
                'name' => 'manager',
                'guard_name' => 'web',
                'description' => 'Manager role with access to common business functions but limited administrative capabilities.',
                'permissions' => Permission::where('module', '!=', 'system')
                    ->whereNotIn('name', [
                        'delete-users',
                        'create-roles',
                        'update-roles',
                        'delete-roles',
                        'create-permissions',
                        'update-permissions',
                        'delete-permissions',
                    ])->pluck('name')->toArray(),
            ],
            [
                'name' => 'editor',
                'guard_name' => 'web',
                'description' => 'Editor role with permissions to create and edit content but not manage users or system settings.',
                'permissions' => [
                    'view-dashboard',
                    'view-reports',
                    'export-reports',
                    'update-profile',
                    'change-password',
                ],
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
                'description' => 'Basic user role with access to dashboard and profile management.',
                'permissions' => [
                    'view-dashboard',
                    'update-profile',
                    'change-password',
                ],
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create or update roles and assign permissions
        foreach ($roles as $roleData) {
            // Check if role already exists
            $existingRole = Role::where('name', $roleData['name'])
                ->where('guard_name', $roleData['guard_name'])
                ->first();
                
            if ($existingRole) {
                // Update existing role
                $existingRole->update([
                    'description' => $roleData['description']
                ]);
                
                // Sync permissions
                $existingRole->syncPermissions($roleData['permissions']);
                
                $updatedCount++;
                $this->command->info("Role '{$roleData['name']}' already exists - updated description and permissions.");
            } else {
                // Create new role
                $role = Role::create([
                    'name' => $roleData['name'],
                    'guard_name' => $roleData['guard_name'],
                    'description' => $roleData['description'],
                ]);
                
                // Assign permissions to the role
                $role->syncPermissions($roleData['permissions']);
                
                $createdCount++;
                $this->command->info("Role '{$roleData['name']}' created successfully.");
            }
        }
        
        // Assign superadmin role to the first user (if exists and doesn't already have the role)
        $admin = User::first();
        if ($admin) {
            if (!$admin->hasRole('superadmin')) {
                $admin->assignRole('superadmin');
                $this->command->info("Assigned 'superadmin' role to the first user (ID: {$admin->id}).");
            } else {
                $this->command->info("First user (ID: {$admin->id}) already has 'superadmin' role.");
            }
        } else {
            $this->command->warn("No users found in database - no roles assigned.");
        }

        $this->command->info("Roles processed: {$createdCount} created, {$updatedCount} updated.");
    }
}