<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Wave\Http\Controllers\HomeController;
use App\Http\Controllers\Tenant\UsersController;
use App\Http\Controllers\Tenant\RolesController;
use App\Http\Controllers\Tenant\PermissionsController;

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
    Route::prefix('tenant')->name('tenant.')->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::middleware('auth')->group(function() {
            Route::resource('users', UsersController::class);
            Route::resource('roles', RolesController::class);
            Route::resource('permissions', PermissionsController::class);
        });
      
    });
    
    Route::get('/user', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id') . Auth::user();
    });

    require __DIR__ . '/tenant-auth.php';
});

