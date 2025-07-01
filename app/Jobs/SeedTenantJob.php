<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SeedTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function handle(): void
    {
        try {
            Log::info('Starting tenant seeding for: ' . $this->tenant->id);

            // Pastikan tenant aktif sebelum seeding
            if (!$this->tenant->is_active) {
                Log::warning('Tenant is not active, skipping seeding: ' . $this->tenant->id);
                return;
            }

            // Jalankan seeding dalam context tenant
            $this->tenant->run(function () {
                // Check if user already exists
                $existingUser = User::where('email', $this->tenant->email)->first();
                
                if (!$existingUser) {
                    // Create user in tenant database
                    $user = User::create([
                        'name'     => $this->tenant->nama,
                        'email'    => $this->tenant->email,
                        'password' => $this->tenant->password, 
                        'email_verified_at' => now(),
                    ]);

                    Log::info('User created in tenant database: ' . $user->email);

                    // Assign role if using Spatie Permission
                    if (method_exists($user, 'assignRole')) {
                        $user->assignRole('admin'); // atau 'superadmin'
                    }
                } else {
                    Log::info('User already exists in tenant database: ' . $existingUser->email);
                }
            });

            // Run tenant seeders
            Log::info('Running tenant seeders for: ' . $this->tenant->id);
            
            Artisan::call('tenants:seed', [
                '--tenants' => [$this->tenant->id],
            ]);
            Artisan::call('optimize:clear');
            Artisan::call('tenants:seed');
            Log::info('Tenant seeding completed for: ' . $this->tenant->id);

        } catch (\Exception $e) {
            Log::error('Tenant seeding failed for ' . $this->tenant->id . ': ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            // Re-throw exception to mark job as failed
            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('SeedTenantJob failed for tenant ' . $this->tenant->id . ': ' . $exception->getMessage());
    }
}