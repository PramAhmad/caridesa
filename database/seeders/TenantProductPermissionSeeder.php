<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TenantProductPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Define product-related permissions
        $productPermissions = [
            // Product Management
            'products' => [
                'manage-products' => 'Full product management access',
                'view-products' => 'View products list and details',
                'create-products' => 'Create new products',
                'edit-products' => 'Edit existing products',
                'delete-products' => 'Delete products',
                'upload-product-images' => 'Upload product images',
                'manage-product-stock' => 'Manage product stock status',
                'set-product-discounts' => 'Set product discounts and promotions',
                'export-products' => 'Export products data',
                'import-products' => 'Import products data',
                'publish-products' => 'Publish/unpublish products',
                'duplicate-products' => 'Duplicate existing products',
            ],
            
            // Category Management
            'categories' => [
                'manage-categories' => 'Full category management access',
                'view-categories' => 'View product categories',
                'create-categories' => 'Create new product categories',
                'edit-categories' => 'Edit existing categories',
                'delete-categories' => 'Delete categories',
                'organize-categories' => 'Organize and structure categories',
                'export-categories' => 'Export categories data',
                'import-categories' => 'Import categories data',
            ],
            
            // Product Analytics
            'product-analytics' => [
                'view-product-analytics' => 'View product performance analytics',
                'view-product-reports' => 'View detailed product reports',
                'export-product-analytics' => 'Export product analytics data',
                'view-sales-statistics' => 'View product sales statistics',
                'view-inventory-reports' => 'View inventory and stock reports',
            ],
            
            // Product SEO
            'product-seo' => [
                'manage-product-seo' => 'Manage product SEO settings',
                'edit-product-meta' => 'Edit product meta descriptions and keywords',
                'manage-product-urls' => 'Manage product URLs and slugs',
                'optimize-product-content' => 'Optimize product content for SEO',
            ],
        ];
        
        $createdCount = 0;
        $updatedCount = 0;
        
        // Create permissions
        foreach ($productPermissions as $module => $modulePermissions) {
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
        
        $this->command->info("Product permissions processed: {$createdCount} created, {$updatedCount} updated.");
    }
}