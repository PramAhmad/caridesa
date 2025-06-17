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
use App\Http\Controllers\Tenant\ProductController;
use App\Http\Controllers\Tenant\ThemeController;

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
    
    Route::middleware('auth')->group(function() {
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
     // Profile routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'show')->name('profile.show');
        Route::get('profile/edit', 'edit')->name('profile.edit');
        Route::put('profile', 'update')->name('profile.update');
        Route::get('profile/password', 'editPassword')->name('profile.password.edit');
        Route::put('profile/password', 'updatePassword')->name('profile.password.update');
    });

    // Settings routes
    Route::get('/settings/general', [SettingsController::class, 'general']);
    Route::put('/settings/general', [SettingsController::class, 'updateGeneral']);
    Route::get('/settings/security', [SettingsController::class, 'security']);
    Route::put('/settings/security', [SettingsController::class, 'updateSecurity']);



    Route::prefix('/settings/backups')->name('tenant.settings.')->middleware(['auth'])->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('backups');
        Route::post('/create', [BackupController::class, 'create'])->name('backups.create');
        Route::get('/download/{filename}', [BackupController::class, 'download'])->name('backups.download');
        Route::delete('/delete/{filename}', [BackupController::class, 'destroy'])->name('backups.destroy');
        Route::post('/restore/{filename}', [BackupController::class, 'restore'])->name('backups.restore');
    });
    Route::prefix('/logs')->name('tenant.logs.')->middleware(['auth'])->group(function () {
        Route::get('/', [ActivityLogController::class, 'index'])->name('index');
        Route::get('/export', [ActivityLogController::class, 'export'])->name('export');
        Route::delete('/clear', [ActivityLogController::class, 'clear'])->name('clear');
        Route::get('/{id}', [ActivityLogController::class, 'show'])->name('show');
    });

    // Theme Management Routes
    Route::prefix('/admin/themes')->name('tenant.themes.')->group(function () {
        Route::get('/', [App\Http\Controllers\Tenant\ThemeController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Tenant\ThemeController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Tenant\ThemeController::class, 'store'])->name('store');
        Route::get('/{theme}/edit', [App\Http\Controllers\Tenant\ThemeController::class, 'edit'])->name('edit');
        Route::put('/{theme}', [App\Http\Controllers\Tenant\ThemeController::class, 'update'])->name('update');
        Route::delete('/{theme}', [App\Http\Controllers\Tenant\ThemeController::class, 'destroy'])->name('destroy');
        Route::patch('/{theme}/activate', [App\Http\Controllers\Tenant\ThemeController::class, 'activate'])->name('activate');
        Route::get('/{theme}/edit-content', [App\Http\Controllers\Tenant\ThemeController::class, 'editContent'])->name('edit-content');
        Route::put('/{theme}/update-content', [App\Http\Controllers\Tenant\ThemeController::class, 'updateContent'])->name('update-content');
    });
    
    Route::get('/user', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id') . Auth::user();
    });

    Route::resource('category-products', CategoryProductController::class);
    Route::resource('products', ProductController::class);

    require __DIR__ . '/tenant-auth.php';
});

