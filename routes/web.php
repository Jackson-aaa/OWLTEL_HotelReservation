<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;

//Routes only for admin
Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});

//Routes only for customer
Route::middleware([CustomerMiddleware::class])->prefix('/')->group(function () {
    Route::get('/', [DashboardController::class, 'showDashboard']);
    Route::get('/booking-history', [BookingController::class, 'showBookingHistory']);
});

//Global routes
Route::get('/auth', [AuthController::class, 'showAuthPage'])->middleware('guest')->name('auth');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

