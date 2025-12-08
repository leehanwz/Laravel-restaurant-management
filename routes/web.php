<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DrinkController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\ComboItemController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\Kitchen\KitchenController;
use App\Http\Controllers\Table\TableController; // Controller cho khách tại bàn
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\ProfileController;

// Breeze / auth routes
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| CLIENT SITE (Trang chủ chung)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN SITE (Role 1)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Quản lý Resource cơ bản
    Route::resource('menu', MenuController::class);
    Route::resource('product', ProductController::class);
    Route::resource('drink', DrinkController::class);
    Route::resource('combos', ComboController::class);

    // --- Quản lý Combo Items (Viết gọn lại) ---
    Route::controller(ComboItemController::class)->group(function () {
        Route::get('combos/items/select', 'selectCombo')->name('combos.items.selectCombo');

        Route::prefix('combos')->group(function () {
            Route::get('{comboId}/items', 'index')->name('combos.items.index');
            Route::post('items', 'store')->name('combos.items.store');
            Route::put('items/{comboId}/{productId}', 'update')->name('combos.items.update');
            Route::delete('items/{comboId}/{productId}', 'destroy')->name('combos.items.destroy');
        });
    });

    // --- Quản lý Khu vực & Bàn ---
    Route::resource('areas', AreaController::class);
    Route::post('areas/{id}/restore', [AreaController::class, 'restore'])->name('areas.restore');

    Route::resource('tables', AdminTableController::class);
    Route::post('tables/{id}/restore', [AdminTableController::class, 'restore'])->name('tables.restore');

    // Dashboard chung cho Khu vực & Bàn
    Route::get('khu-vuc-ban-an', [AreaController::class, 'dashboard'])->name('khu-vuc-ban-an');
});

/*
|--------------------------------------------------------------------------
| CASHIER SITE (Role 2)
|--------------------------------------------------------------------------
| Lưu ý: Admin (Role 1) vẫn vào được nhờ Middleware thông minh
*/
Route::prefix('cashier')->name('cashier.')->middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard', [CashierController::class, 'index'])->name('dashboard');
    // Thêm các route bán hàng, thanh toán tại đây...
});

/*
|--------------------------------------------------------------------------
| KITCHEN SITE (Role 3)
|--------------------------------------------------------------------------
*/
Route::prefix('kitchen')->name('kitchen.')->middleware(['auth', 'role:3'])->group(function () {
    Route::get('/dashboard', [KitchenController::class, 'index'])->name('dashboard');
    // Thêm route cập nhật trạng thái món ăn...
});

/*
|--------------------------------------------------------------------------
| TABLE QR ORDER SITE (Role 4) - Khách quét mã tại bàn
|--------------------------------------------------------------------------
*/
Route::prefix('table')->name('table.')->middleware(['auth', 'role:4'])->group(function () {
    Route::get('/dashboard', [TableController::class, 'index'])->name('dashboard');
    // Thêm route gọi món...
});

/*
|--------------------------------------------------------------------------
| CUSTOMER SITE (Role 5) - Khách đặt online từ xa
|--------------------------------------------------------------------------
*/
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:5'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PROFILE (Dùng chung cho mọi user đã login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
