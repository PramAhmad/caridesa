<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TenantHomestayPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $homestayPermissions = [
            'homestays' => [
                'manage-homestays' => 'Full homestay management access',
                'view-homestays' => 'View homestays list and details',
                'create-homestays' => 'Create new homestays',
                'edit-homestays' => 'Edit existing homestays',
                'delete-homestays' => 'Delete homestays',
                'upload-homestay-images' => 'Upload homestay images and galleries',
                'manage-homestay-status' => 'Manage homestay active/inactive status',
                'set-homestay-pricing' => 'Set homestay rates and pricing',
                'export-homestays' => 'Export homestays data',
                'import-homestays' => 'Import homestays data',
                'publish-homestays' => 'Publish/unpublish homestays',
                'duplicate-homestays' => 'Duplicate existing homestays',
                'manage-homestay-facilities' => 'Manage homestay facilities and amenities',
                'manage-homestay-availability' => 'Manage homestay room availability',
                'set-homestay-discounts' => 'Set homestay discounts and promotions',
            ],
            
            // Homestay Analytics & Reports
            'homestay-analytics' => [
                'view-homestay-analytics' => 'View homestay performance analytics',
                'view-homestay-reports' => 'View detailed homestay reports',
                'export-homestay-analytics' => 'Export homestay analytics data',
                'view-occupancy-statistics' => 'View homestay occupancy statistics',
                'view-revenue-reports' => 'View homestay revenue and booking reports',
                'view-guest-statistics' => 'View homestay guest statistics and demographics',
                'view-rating-metrics' => 'View homestay rating and review metrics',
                'generate-homestay-insights' => 'Generate homestay business insights',
                'view-seasonal-trends' => 'View homestay seasonal booking trends',
            ],
            
            // Homestay SEO & Marketing
            'homestay-marketing' => [
                'manage-homestay-seo' => 'Manage homestay SEO settings',
                'edit-homestay-meta' => 'Edit homestay meta descriptions and keywords',
                'manage-homestay-urls' => 'Manage homestay URLs and slugs',
                'optimize-homestay-content' => 'Optimize homestay content for SEO',
                'manage-homestay-promotions' => 'Manage homestay promotions and special offers',
                'create-homestay-packages' => 'Create homestay packages and deals',
                'manage-homestay-social-media' => 'Manage homestay social media integration',
                'manage-homestay-listings' => 'Manage homestay listings on external platforms',
                'create-marketing-campaigns' => 'Create homestay marketing campaigns',
            ],
            
            // Homestay Booking & Reservations
            'homestay-bookings' => [
                'view-homestay-bookings' => 'View homestay bookings and reservations',
                'manage-homestay-bookings' => 'Manage homestay booking system',
                'process-homestay-payments' => 'Process homestay booking payments',
                'handle-homestay-cancellations' => 'Handle homestay booking cancellations',
                'manage-booking-calendar' => 'Manage homestay availability calendar',
                'generate-booking-reports' => 'Generate homestay booking reports',
                'manage-check-in-out' => 'Manage homestay check-in and check-out',
                'handle-booking-modifications' => 'Handle homestay booking modifications',
                'manage-waiting-list' => 'Manage homestay booking waiting list',
                'send-booking-confirmations' => 'Send homestay booking confirmations',
            ],
            
            // Homestay Reviews & Ratings
            'homestay-reviews' => [
                'view-homestay-reviews' => 'View homestay reviews and ratings',
                'moderate-homestay-reviews' => 'Moderate and manage homestay reviews',
                'respond-to-reviews' => 'Respond to homestay reviews',
                'manage-review-settings' => 'Manage homestay review system settings',
                'export-review-data' => 'Export homestay review data',
                'flag-inappropriate-reviews' => 'Flag inappropriate homestay reviews',
                'generate-review-reports' => 'Generate homestay review analysis reports',
            ],
            
            // Homestay Guest Management
            'homestay-guests' => [
                'view-guest-profiles' => 'View homestay guest profiles',
                'manage-guest-communications' => 'Manage communications with homestay guests',
                'view-guest-history' => 'View homestay guest booking history',
                'manage-guest-preferences' => 'Manage homestay guest preferences',
                'handle-guest-requests' => 'Handle special guest requests',
                'manage-guest-feedback' => 'Manage homestay guest feedback',
                'create-guest-loyalty-programs' => 'Create guest loyalty programs',
                'send-guest-newsletters' => 'Send newsletters to homestay guests',
            ],
            
            // Homestay Maintenance & Operations
            'homestay-operations' => [
                'manage-homestay-maintenance' => 'Manage homestay maintenance schedules',
                'track-homestay-inventory' => 'Track homestay inventory and supplies',
                'manage-cleaning-schedules' => 'Manage homestay cleaning schedules',
                'handle-maintenance-requests' => 'Handle homestay maintenance requests',
                'manage-service-providers' => 'Manage homestay service providers',
                'track-operational-costs' => 'Track homestay operational costs',
                'manage-safety-protocols' => 'Manage homestay safety protocols',
                'generate-maintenance-reports' => 'Generate homestay maintenance reports',
            ],
            
            // Homestay Financial Management
            'homestay-finance' => [
                'view-homestay-finances' => 'View homestay financial data',
                'manage-homestay-expenses' => 'Manage homestay expenses and costs',
                'generate-financial-reports' => 'Generate homestay financial reports',
                'manage-tax-information' => 'Manage homestay tax information',
                'track-profit-loss' => 'Track homestay profit and loss',
                'manage-payment-methods' => 'Manage homestay payment methods',
                'handle-refunds' => 'Handle homestay booking refunds',
                'manage-invoicing' => 'Manage homestay invoicing system',
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create permissions
        foreach ($homestayPermissions as $module => $modulePermissions) {
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
        
        $this->command->info("Homestay permissions processed: {$createdCount} created, {$updatedCount} updated.");
    }
}