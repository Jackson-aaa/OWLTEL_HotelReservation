<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;

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
});

//Routes only for customer
Route::middleware([CustomerMiddleware::class])->prefix('/')->group(function () {
    Route::get('/', function () {
        return view('guest.dashboard');
    })->name('dashboard');
});

//Global routes
Route::get('/auth', [AuthController::class, 'showAuthPage'])->middleware('guest')->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');