<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImportProductsController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileCotroller;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:admin'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard',
], function () {

    Route::get('profile', [ProfileCotroller::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileCotroller::class, 'update'])->name('profile.update');

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/notification', [DashboardController::class, 'notify'])
        ->name('notification');
    Route::get('/notification/markAsRead', [DashboardController::class, 'markAsRead'])
        ->name('notification.markAsRead');

    Route::get('/categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.force-delete');

    Route::get('products/import', [ImportProductsController::class, 'create'])
        ->name('products.import');
    Route::post('products/import', [ImportProductsController::class, 'store']);

    Route::resource('users', UsersController::class)->except([
        'create',
        'store'
    ]);

    Route::resources([
        'products' => ProductsController::class,
        'categories' => CategoriesController::class,
        'stores' => StoreController::class,
        'orders' => OrdersController::class,
        'roles' => RolesController::class,
        'admins' => AdminsController::class,
    ]);
});

// Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function() {

// });