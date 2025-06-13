<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the tenant's database.
     */
    public function run(): void
    {
        $this->call(PermissionsTenantSeeder::class);
        $this->call(RolesTenantTableSeeder::class);
    }
}