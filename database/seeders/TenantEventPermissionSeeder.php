<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TenantEventPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Define event-related permissions
        $eventPermissions = [
            // Event Management
            'events' => [
                'manage-events' => 'Full event management access',
                'view-events' => 'View events list and details',
                'create-events' => 'Create new events',
                'edit-events' => 'Edit existing events',
                'delete-events' => 'Delete events',
                'publish-events' => 'Publish/unpublish events',
                'toggle-event-status' => 'Toggle event active status',
            ],
            
            // Event Images
            'event-images' => [
                'upload-event-images' => 'Upload event images',
                'delete-event-images' => 'Delete event images',
                'manage-event-gallery' => 'Manage event image gallery',
            ],
            
            // Event Analytics
            'event-analytics' => [
                'view-event-analytics' => 'View event analytics and statistics',
                'view-event-reports' => 'View detailed event reports',
                'export-event-data' => 'Export event data and reports',
            ],
            
            // Event Calendar
            'event-calendar' => [
                'view-event-calendar' => 'View event calendar',
                'manage-event-schedule' => 'Manage event scheduling',
                'view-upcoming-events' => 'View upcoming events',
                'view-ongoing-events' => 'View ongoing events',
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create permissions
        foreach ($eventPermissions as $module => $modulePermissions) {
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
        
        $this->command->info("Event permissions processed: {$createdCount} created, {$updatedCount} updated.");
    }
}