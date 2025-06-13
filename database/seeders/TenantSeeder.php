<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \DB::table('tenants')->delete();
        $tenant = Tenant::create([
                    'id' => 4,
                    'name' => 'garutkoperasi2',
                    'email' => 'adit@mail.com',
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'data' => json_encode(array (
                        'updated_at' => now(),
                        'created_at' => now(),
                        'domain_name' => 'adit',
                        'tenancy_db_name' => 'garut_adit',
                    )),
                ]);
            
        $tenant->domains()->create([
            'domain' => 'adit.localhost',
        ]);
    }
}
