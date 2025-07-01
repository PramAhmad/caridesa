<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the tenant's database.
     */
    public function run(): void
    {
        $this->call(PermissionsTenantSeeder::class);
        $this->call(RolesTenantTableSeeder::class);
        $this->call(TenantWisataPermissionSeeder::class);
        $this->call(TenantProductPermissionSeeder::class);
        $this->call(TenantEventPermissionSeeder::class);
        $this->call(TenantHomestayPermissionSeeder::class);
        $this->call(TenantGuidePermissionSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(PermissionTenantTableSeeder::class);
          try {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            $roleName = 'admin';
            $permissions = Permission::all();
            if ($permissions->isEmpty()) {
                $this->command->error("No permissions found. Please run PermissionSeeder first.");
                return;
            }

            $role = Role::firstOrCreate(['name' => $roleName]);
            
            if ($role->wasRecentlyCreated) {
                $this->command->info("Created new role: {$roleName}");
            } else {
                $this->command->info("Found existing role: {$roleName}");
            }

            $role->syncPermissions($permissions);
            
            $this->command->info("Successfully assigned {$permissions->count()} permissions to the {$roleName} role.");
            
            $this->command->info("Permissions assigned:");
            foreach ($permissions as $permission) {
                $this->command->line("  - {$permission->name}");
            }
            
        } catch (\Exception $e) {
            $this->command->error("Error assigning permissions: " . $e->getMessage());
            throw $e;
        }

    }
}