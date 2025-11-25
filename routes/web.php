<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\Kitchen\KitchenController;
use App\Http\Controllers\Table\TableController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Shop\HomeController;

// Breeze / auth routes
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| CLIENT SITE
|--------------------------------------------------------------------------
*/

// Trang chủ public
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN SITE (role 1)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Ví dụ resource quản lý menu, product, drink, combo
    Route::resource('menu', \App\Http\Controllers\Admin\MenuController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('drink', \App\Http\Controllers\Admin\DrinkController::class);
    Route::resource('combos', \App\Http\Controllers\Admin\ComboController::class);

    // Combo Item Management
    Route::get('combos/items/select', [\App\Http\Controllers\Admin\ComboItemController::class, 'selectCombo'])
        ->name('combos.items.selectCombo');

    Route::prefix('combos')->group(function () {
        Route::get('{comboId}/items', [\App\Http\Controllers\Admin\ComboItemController::class, 'index'])
            ->name('combos.items.index');
        Route::post('items', [\App\Http\Controllers\Admin\ComboItemController::class, 'store'])
            ->name('combos.items.store');
        Route::put('items/{comboId}/{productId}', [\App\Http\Controllers\Admin\ComboItemController::class, 'update'])
            ->name('combos.items.update');
        Route::delete('items/{comboId}/{productId}', [\App\Http\Controllers\Admin\ComboItemController::class, 'destroy'])
            ->name('combos.items.destroy');
    });

    // Quản lý khu vực
    Route::resource('areas', \App\Http\Controllers\Admin\AreaController::class);
    Route::post('areas/{id}/restore', [\App\Http\Controllers\Admin\AreaController::class, 'restore'])
        ->name('areas.restore');
    // Quản lý bàn
    Route::resource('tables', \App\Http\Controllers\Admin\TableController::class);
    Route::post('tables/{id}/restore', [\App\Http\Controllers\Admin\TableController::class, 'restore'])
        ->name('tables.restore');
    // Form khu và bàn ăn chung   
    Route::get('khu-vuc-ban-an', [\App\Http\Controllers\Admin\AreaController::class, 'dashboard'])->name('khu-vuc-ban-an');      
});

/*
|--------------------------------------------------------------------------
| CASHIER SITE (role 2)
|--------------------------------------------------------------------------
*/
// Route::prefix('cashier')->name('cashier.')->middleware(['auth', 'role:2'])->group(function () {
//     Route::get('/dashboard', [CashierController::class, 'index'])->name('dashboard');
// });

/*
|--------------------------------------------------------------------------
| KITCHEN SITE (role 3)
|--------------------------------------------------------------------------
*/
// Route::prefix('kitchen')->name('kitchen.')->middleware(['auth', 'role:3'])->group(function () {
//     Route::get('/dashboard', [KitchenController::class, 'index'])->name('dashboard');
// });

/*
|--------------------------------------------------------------------------
| TABLE SITE (role 4)
|--------------------------------------------------------------------------
*/
// Route::prefix('table')->name('table.')->middleware(['auth', 'role:4'])->group(function () {
//     Route::get('/dashboard', [TableController::class, 'index'])->name('dashboard');
// });

/*
|--------------------------------------------------------------------------
| CUSTOMER SITE (role 5)
|--------------------------------------------------------------------------
*/
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:5'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| BREEZE DASHBOARD & PROFILE
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // Nếu muốn có dashboard chung, ví dụ cho user đã verify email
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});


