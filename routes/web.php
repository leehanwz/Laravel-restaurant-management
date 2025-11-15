<?php

use Illuminate\Support\Facades\Route;

// Controller Admin Routes

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DrinkController;

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
    // Route::get('/about', [AboutController::class, 'index'])->name('about');
    // Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    // Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    // Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    // Route::get('/service', [ServiceController::class, 'index'])->name('service');
    // Route::get('/team', [TeamController::class, 'index'])->name('team');
    // Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
});

// ==================== ADMIN SITE ====================
Route::prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Menu Management
        Route::resource('menu', MenuController::class);
        // Product Management
        Route::resource('product', ProductController::class);
        // Drink Management
        Route::resource('drink', DrinkController::class);
    }
);
