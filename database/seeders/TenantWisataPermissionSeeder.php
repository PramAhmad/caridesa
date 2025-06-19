<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TenantWisataPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $wisataPermissions = [
            'wisatas' => [
                'manage-wisatas' => 'Full wisata management access',
                'view-wisatas' => 'View wisatas list and details',
                'create-wisatas' => 'Create new wisatas',
                'edit-wisatas' => 'Edit existing wisatas',
                'delete-wisatas' => 'Delete wisatas',
                'upload-wisata-images' => 'Upload wisata images and galleries',
                'manage-wisata-status' => 'Manage wisata active/inactive status',
                'set-wisata-pricing' => 'Set wisata ticket prices and packages',
                'export-wisatas' => 'Export wisatas data',
                'import-wisatas' => 'Import wisatas data',
                'publish-wisatas' => 'Publish/unpublish wisatas',
                'duplicate-wisatas' => 'Duplicate existing wisatas',
                'manage-wisata-facilities' => 'Manage wisata facilities and amenities',
                'manage-wisata-schedules' => 'Manage wisata opening hours and schedules',
            ],
            
            // Category Wisata Management
            'category-wisatas' => [
                'manage-category-wisatas' => 'Full category wisata management access',
                'view-category-wisatas' => 'View wisata categories',
                'create-category-wisatas' => 'Create new wisata categories',
                'edit-category-wisatas' => 'Edit existing wisata categories',
                'delete-category-wisatas' => 'Delete wisata categories',
                'organize-category-wisatas' => 'Organize and structure wisata categories',
                'export-category-wisatas' => 'Export wisata categories data',
                'import-category-wisatas' => 'Import wisata categories data',
            ],
            
            // Wisata Analytics & Reports
            'wisata-analytics' => [
                'view-wisata-analytics' => 'View wisata performance analytics',
                'view-wisata-reports' => 'View detailed wisata reports',
                'export-wisata-analytics' => 'Export wisata analytics data',
                'view-visitor-statistics' => 'View wisata visitor statistics',
                'view-revenue-reports' => 'View wisata revenue and booking reports',
                'view-popularity-metrics' => 'View wisata popularity and rating metrics',
                'generate-wisata-insights' => 'Generate wisata business insights',
            ],
            
            // Wisata SEO & Marketing
            'wisata-marketing' => [
                'manage-wisata-seo' => 'Manage wisata SEO settings',
                'edit-wisata-meta' => 'Edit wisata meta descriptions and keywords',
                'manage-wisata-urls' => 'Manage wisata URLs and slugs',
                'optimize-wisata-content' => 'Optimize wisata content for SEO',
                'manage-wisata-promotions' => 'Manage wisata promotions and discounts',
                'create-wisata-packages' => 'Create wisata tour packages',
                'manage-wisata-social-media' => 'Manage wisata social media integration',
            ],
            
            // Wisata Booking & Reservations
            'wisata-bookings' => [
                'view-wisata-bookings' => 'View wisata bookings and reservations',
                'manage-wisata-bookings' => 'Manage wisata booking system',
                'process-wisata-payments' => 'Process wisata booking payments',
                'handle-wisata-cancellations' => 'Handle wisata booking cancellations',
                'manage-booking-calendar' => 'Manage wisata availability calendar',
                'generate-booking-reports' => 'Generate wisata booking reports',
            ],
            
            // Wisata Reviews & Ratings
            'wisata-reviews' => [
                'view-wisata-reviews' => 'View wisata reviews and ratings',
                'moderate-wisata-reviews' => 'Moderate and manage wisata reviews',
                'respond-to-reviews' => 'Respond to wisata reviews',
                'manage-review-settings' => 'Manage wisata review system settings',
                'export-review-data' => 'Export wisata review data',
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create permissions
        foreach ($wisataPermissions as $module => $modulePermissions) {
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
        
        $this->command->info("Wisata permissions processed: {$createdCount} created, {$updatedCount} updated.");
    }
}