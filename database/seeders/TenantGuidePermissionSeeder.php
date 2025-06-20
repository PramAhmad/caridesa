<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TenantGuidePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Define guide-related permissions
        $guidePermissions = [
            // Guide Management
            'guides' => [
                'manage-guides' => 'Full guide management access',
                'view-guides' => 'View guides list and details',
                'create-guides' => 'Create new guides',
                'edit-guides' => 'Edit existing guides',
                'delete-guides' => 'Delete guides',
                'publish-guides' => 'Publish/unpublish guides',
                'toggle-guide-status' => 'Toggle guide active status',
                'view-guide-details' => 'View detailed guide information',
                'manage-guide-pricing' => 'Manage guide pricing and discounts',
            ],
            
            // Guide Images
            'guide-images' => [
                'upload-guide-images' => 'Upload guide images',
                'delete-guide-images' => 'Delete guide images',
                'manage-guide-gallery' => 'Manage guide image gallery',
                'view-guide-images' => 'View guide images',
            ],
            
            // Guide Analytics
            'guide-analytics' => [
                'view-guide-analytics' => 'View guide analytics and statistics',
                'view-guide-reports' => 'View detailed guide reports',
                'export-guide-data' => 'Export guide data and reports',
                'view-guide-performance' => 'View guide performance metrics',
                'view-guide-bookings' => 'View guide booking statistics',
            ],
            
            // Guide Bookings
            'guide-bookings' => [
                'view-guide-bookings' => 'View guide bookings',
                'manage-guide-bookings' => 'Manage guide bookings',
                'approve-guide-bookings' => 'Approve guide bookings',
                'cancel-guide-bookings' => 'Cancel guide bookings',
                'view-booking-calendar' => 'View guide booking calendar',
            ],
            
            // Guide Reviews
            'guide-reviews' => [
                'view-guide-reviews' => 'View guide reviews and ratings',
                'manage-guide-reviews' => 'Manage guide reviews',
                'respond-guide-reviews' => 'Respond to guide reviews',
                'moderate-guide-reviews' => 'Moderate guide reviews',
            ],
            
            // Guide Finances
            'guide-finances' => [
                'view-guide-finances' => 'View guide financial data',
                'manage-guide-payments' => 'Manage guide payments',
                'view-guide-earnings' => 'View guide earnings',
                'generate-guide-invoices' => 'Generate guide invoices',
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create permissions
        foreach ($guidePermissions as $module => $modulePermissions) {
            foreach ($modulePermissions as $name => $description) {
                $existingPermission = Permission::where('name', $name)->first();
                
                if ($existingPermission) {
                    // Update existing permission
                    $existingPermission->update([
                        'description' => $description,
                        'module' => $module,
                    ]);
                    $updatedCount++;
                    $this->command->info("Permission '{$name}' updated for module '{$module}'.");
                } else {
                    // Create new permission
                    Permission::create([
                        'name' => $name,
                        'guard_name' => 'web',
                        'description' => $description,
                        'module' => $module,
                    ]);
                    $createdCount++;
                    $this->command->info("Permission '{$name}' created for module '{$module}'.");
                }
            }
        }
        
        $this->command->info("Guide permissions processed: {$createdCount} created, {$updatedCount} updated.");
    }
}