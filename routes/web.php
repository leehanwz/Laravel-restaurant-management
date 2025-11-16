<?php

use Illuminate\Support\Facades\Route;

// Controller Admin Routes
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DrinkController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\ComboItemController;

// Shop Routes
use App\Http\Controllers\shop\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== CLIENT SITE ====================
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// ==================== ADMIN SITE ====================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Management
    Route::resource('menu', MenuController::class);

    // Product Management
    Route::resource('product', ProductController::class);

    // Drink Management
    Route::resource('drink', DrinkController::class);

    // Combo Management
    Route::resource('combos', ComboController::class);

    // ==================== Combo Item Management ====================
    // Trang chọn combo trước khi quản lý món
    Route::get('combos/items/select', [ComboItemController::class, 'selectCombo'])
        ->name('combos.items.selectCombo');

    // Quản lý món trong combo đã chọn
    Route::prefix('combos')->group(function () {
        Route::get('{comboId}/items', [ComboItemController::class, 'index'])
            ->name('combos.items.index');

        Route::post('items', [ComboItemController::class, 'store'])
            ->name('combos.items.store');

        Route::put('items/{comboId}/{productId}', [ComboItemController::class, 'update'])
            ->name('combos.items.update');

        Route::delete('items/{comboId}/{productId}', [ComboItemController::class, 'destroy'])
            ->name('combos.items.destroy');
    });
});
