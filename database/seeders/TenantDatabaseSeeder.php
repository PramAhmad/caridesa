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
        $this->call(ThemesTableSeeder::class);
        $this->call(TenantWisataPermissionSeeder::class);
        $this->call(TenantProductPermissionSeeder::class);
        $this->call(TenantEventPermissionSeeder::class);
        $this->call(TenantGuidePermissionSeeder::class);
        
    }
}