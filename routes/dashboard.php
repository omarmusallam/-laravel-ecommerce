<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImagesController;
use App\Http\Controllers\Dashboard\ImportProductsController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\PrintPDF;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileCotroller;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\SettingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:admin'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard',
], function () {
    // Home Page
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/charts/orders', [DashboardController::class, 'orderChart'])
        ->name('charts.orders');

    Route::get('profile', [ProfileCotroller::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileCotroller::class, 'update'])->name('profile.update');


    Route::get('/notification', [DashboardController::class, 'notify'])
        ->name('notification');
    Route::get('/notification/markAsRead', [DashboardController::class, 'markAsRead'])
        ->name('notification.markAsRead');

    // Soft Deletes
    Route::get('/categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.force-delete');
    Route::post('search/categories', [CategoriesController::class, 'ajax_search'])
        ->name('ajax_search_categories');
    Route::post('search/products', [ProductsController::class, 'ajax_search'])
        ->name('ajax_search_products');
    Route::post('delete-image/{category}', [CategoriesController::class, 'deleteImage'])->name('category.deleteImage');
    Route::post('/delete-product-image/{product}', [ProductsController::class, 'deleteGalleryImage'])->name('product.deleteImage');

    // Jobs
    Route::get('products/import', [ImportProductsController::class, 'create'])
        ->name('products.import');
    Route::post('products/import', [ImportProductsController::class, 'store']);

    // Export and Import products from Excel
    Route::get('products/export', [ProductsController::class, 'export'])
        ->name('products.export');
    Route::get('products/import.view', [ProductsController::class, 'importView'])
        ->name('products.import.view');
    Route::post('products.import.store', [ProductsController::class, 'import'])->name('products.import.store');
    // Print Orders
    Route::get('orders/{order}/print', [OrdersController::class, 'print'])
        ->name('orders.print');

    // Settings
    Route::get('setting', [SettingController::class, 'index'])
        ->name('setting');
    Route::post('setting', [SettingController::class, 'store']);

    // nav in dashboard
    Route::resources([
        'categories' => CategoriesController::class,
        'stores' => StoreController::class,
        'products' => ProductsController::class,
        'orders' => OrdersController::class,
        'roles' => RolesController::class,
        'admins' => AdminsController::class,
        'users' => UsersController::class,
    ]);
});