<?php

use Illuminate\Support\Facades\Route;

// Controller Routes

use App\Http\Controllers\admin\DashboardController;

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
    }
);
