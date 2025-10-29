<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DukunController;
use App\Http\Controllers\Admin\BookingApprovalController;
use App\Http\Controllers\Admin\BookingReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\WelcomeController;

// Halaman Landing Page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// === GRUP RUTE KLIEN ===
Route::middleware(['auth', 'verified', 'user'])->group(function () {

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/catalog/{dukun}', [CatalogController::class, 'show'])->name('catalog.show');
    Route::post('/cart/add/{dukun}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/my-bookings/{booking}/request-completion', [BookingController::class, 'requestCompletion'])
         ->name('booking.requestCompletion');
    Route::post('/my-bookings/{booking}/pay-denda', [BookingController::class, 'payDenda'])
         ->name('booking.payDenda');
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('dukuns', DukunController::class);
    Route::resource('users', UserController::class);

    Route::get('/approvals', [BookingApprovalController::class, 'index'])->name('approvals.index');
    Route::post('/approvals/{booking}/approve', [BookingApprovalController::class, 'approve'])->name('approvals.approve');
    
    Route::post('/approvals/{booking}/confirm-payment', [BookingApprovalController::class, 'confirmPayment'])
         ->name('approvals.confirmPayment');

    Route::get('/reports/active', [BookingReportController::class, 'activeBookings'])->name('reports.active');
    Route::get('/reports/history', [BookingReportController::class, 'historyBookings'])->name('reports.history');
    Route::get('/reports/history/{booking}', [BookingReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/history/print', [BookingReportController::class, 'printHistory'])->name('reports.print');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';