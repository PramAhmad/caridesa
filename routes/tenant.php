<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\ActivityLogController;
use App\Http\Controllers\Tenant\BackupController;
use App\Http\Controllers\Tenant\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Wave\Http\Controllers\HomeController;
use App\Http\Controllers\Tenant\UsersController;
use App\Http\Controllers\Tenant\RolesController;
use App\Http\Controllers\Tenant\PermissionsController;
use App\Http\Controllers\Tenant\ProfileController;
use App\Http\Controllers\Tenant\CategoryProductController;
use App\Http\Controllers\Tenant\CategoryWisataController;
use App\Http\Controllers\Tenant\ProductController;
use App\Http\Controllers\Tenant\ThemeController;
use App\Http\Controllers\Tenant\WisataController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    
    Route::get('/', [HomeController::class, 'home'])->name('home');

    // All admin routes with prefix
    Route::prefix('admin')->middleware('auth')->group(function() {
        
        // User Management Routes
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
        
        // Profile routes
        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'show')->name('profile.show');
            Route::get('profile/edit', 'edit')->name('profile.edit');
            Route::put('profile', 'update')->name('profile.update');
            Route::get('profile/password', 'editPassword')->name('profile.password.edit');
            Route::put('profile/password', 'updatePassword')->name('profile.password.update');
        });

        // Settings routes
        Route::get('settings/general', [SettingsController::class, 'general'])->name('settings.general');
        Route::put('settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('settings/security', [SettingsController::class, 'security'])->name('settings.security');
        Route::put('settings/security', [SettingsController::class, 'updateSecurity'])->name('settings.security.update');

        // Backup routes
        Route::prefix('settings/backups')->name('tenant.settings.')->group(function () {
            Route::get('/', [BackupController::class, 'index'])->name('backups');
            Route::post('create', [BackupController::class, 'create'])->name('backups.create');
            Route::get('download/{filename}', [BackupController::class, 'download'])->name('backups.download');
            Route::delete('delete/{filename}', [BackupController::class, 'destroy'])->name('backups.destroy');
            Route::post('restore/{filename}', [BackupController::class, 'restore'])->name('backups.restore');
        });

        // Activity Logs routes
        Route::prefix('logs')->name('tenant.logs.')->group(function () {
            Route::get('/', [ActivityLogController::class, 'index'])->name('index');
            Route::get('export', [ActivityLogController::class, 'export'])->name('export');
            Route::delete('clear', [ActivityLogController::class, 'clear'])->name('clear');
            Route::get('{id}', [ActivityLogController::class, 'show'])->name('show');
        });

        // Theme Management Routes
        Route::prefix('themes')->name('tenant.themes.')->group(function () {
            Route::get('/', [ThemeController::class, 'index'])->name('index');
            Route::get('create', [ThemeController::class, 'create'])->name('create');
            Route::post('/', [ThemeController::class, 'store'])->name('store');
            Route::get('{theme}/edit', [ThemeController::class, 'edit'])->name('edit');
            Route::put('{theme}', [ThemeController::class, 'update'])->name('update');
            Route::delete('{theme}', [ThemeController::class, 'destroy'])->name('destroy');
            Route::patch('{theme}/activate', [ThemeController::class, 'activate'])->name('activate');
            Route::get('{theme}/edit-content', [ThemeController::class, 'editContent'])->name('edit-content');
            Route::put('{theme}/update-content', [ThemeController::class, 'updateContent'])->name('update-content');
        });

        // Product Management Routes
        Route::resource('category-products', CategoryProductController::class);
        Route::resource('products', ProductController::class);

        Route::resource('category-wisatas', CategoryWisataController::class)->names([
            'index' => 'category-wisatas.index',
            'create' => 'category-wisatas.create',
            'store' => 'category-wisatas.store',
            'show' => 'category-wisatas.show',
            'edit' => 'category-wisatas.edit',
            'update' => 'category-wisatas.update',
            'destroy' => 'category-wisatas.destroy',
        ]);

        Route::resource('wisatas', WisataController::class)->names([
            'index' => 'wisatas.index',
            'create' => 'wisatas.create',
            'store' => 'wisatas.store',
            'show' => 'wisatas.show',
            'edit' => 'wisatas.edit',
            'update' => 'wisatas.update',
            'destroy' => 'wisatas.destroy',
        ]);
        // Wisata Analytics Routes
        Route::get('analytics/wisatas', [App\Http\Controllers\Tenant\WisataAnalyticsController::class, 'index'])->name('wisatas.analytics');
        Route::get('analytics/wisatas/export', [App\Http\Controllers\Tenant\WisataAnalyticsController::class, 'export'])->name('wisatas.analytics.export');

        // Delete image route for wisata
        Route::delete('wisata-images/{image}', [WisataController::class, 'deleteImage'])->name('wisata-images.destroy');

        // HomeStay Management Routes
        Route::resource('homestays', App\Http\Controllers\Tenant\HomeStayController::class)->names([
            'index' => 'homestays.index',
            'create' => 'homestays.create',
            'store' => 'homestays.store',
            'show' => 'homestays.show',
            'edit' => 'homestays.edit',
            'update' => 'homestays.update',
            'destroy' => 'homestays.destroy',
        ]);

        // Additional homestay routes
        Route::patch('homestays/{homestay}/toggle-active', [App\Http\Controllers\Tenant\HomeStayController::class, 'toggleActive'])->name('homestays.toggle-active');
        Route::delete('homestay-images/{image}', [App\Http\Controllers\Tenant\HomeStayController::class, 'deleteImage'])->name('homestay-images.destroy');

        Route::get('user', function () {
            return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id') . Auth::user();
        });
    });

    require __DIR__ . '/tenant-auth.php';
});