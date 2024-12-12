<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HotelController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;

//Routes only for admin
Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.layout');
    });

    Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
    Route::post('locations', [LocationController::class, 'store'])->name('locations.store');
    Route::put('/locationsUpdate/{id}', [LocationController::class, 'update'])->name('locations.update');
    Route::get('/locations/{id}', [LocationController::class, 'edit'])->name('locations.edit');
    Route::delete('/locationsDelete/{id}', [LocationController::class, 'destroy'])->name('locations.destroy');

    Route::get('facilities', [FacilityController::class, 'index'])->name('facilities.index');
    Route::post('facilities', [FacilityController::class, 'store'])->name('facilities.store');
    Route::put('/facilitiesUpdate/{id}', [FacilityController::class, 'update'])->name('facilities.update');
    Route::get('/facilities/{id}', [FacilityController::class, 'edit'])->name('facilities.edit');
    Route::delete('/facilitiesDelete/{id}', [FacilityController::class, 'destroy'])->name('facilities.destroy');

    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::put('/paymentsUpdate/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::get('/payments/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::delete('/paymentsDelete/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::post('hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::put('/hotelsUpdate/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::get('/hotels/{id}', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::delete('/hotelsDelete/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    Route::get('paymentdetails', [PaymentDetailController::class, 'index'])->name('paymentdetails.index');
    Route::post('paymentdetails', [PaymentDetailController::class, 'store'])->name('paymentdetails.store');
    Route::put('/paymentdetailsUpdate/{id}', [PaymentDetailController::class, 'update'])->name('paymentdetails.update');
    Route::get('/paymentdetails/{id}', [PaymentDetailController::class, 'edit'])->name('paymentdetails.edit');
    Route::delete('/paymentdetailsDelete/{id}', [PaymentDetailController::class, 'destroy'])->name('paymentdetails.destroy');
});

//Routes only for customer
Route::middleware([CustomerMiddleware::class])->prefix('/')->group(function () {
    Route::get('/', [DashboardController::class, 'showDashboard']);
    Route::get('/booking-history', [BookingController::class, 'showBookingHistory']);
});

//Global routes
Route::get('/auth', [AuthController::class, 'showAuthPage'])->middleware('guest')->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
