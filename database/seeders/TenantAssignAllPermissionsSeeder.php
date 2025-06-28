<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantAssignAllPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = $this->command->option('role') ?? 'admin';

        // Get all permissions
        $permissions = \Spatie\Permission\Models\Permission::all();

        // Assign all permissions to the specified role
        $roleModel = \Spatie\Permission\Models\Role::findByName($role);
        if ($roleModel) {
            $roleModel->syncPermissions($permissions);
            $this->command->info("All permissions assigned to the {$role} role.");
        } else {
            $this->command->error("Role {$role} not found.");
        }
    }
}
