<?php

use App\Http\Controllers\PassengerReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/buses', [AdminController::class, 'manageBuses'])->name('admin.manage.buses');
    Route::post('/buses', [AdminController::class, 'addBus'])->name('admin.add.bus');
    Route::get('/buses/{bus}/edit', [AdminController::class, 'editBus'])->name('admin.edit.bus');
    Route::post('/buses/{bus}/edit', [AdminController::class, 'updateBus'])->name('admin.update.bus');
    Route::delete('/buses/{id}', [AdminController::class, 'deleteBus'])->name('admin.delete.bus');
    
    // Driver registration
    Route::get('/register_driver', [AdminController::class, 'showRegisterDriverForm'])->name('admin.register.driver.form');
    Route::post('/register_driver', [AdminController::class, 'registerDriver'])->name('admin.register.driver');

    // Schedules management
    Route::get('/schedules', [AdminController::class, 'manageSchedules'])->name('admin.schedules');
    Route::post('/schedules', [AdminController::class, 'addSchedule'])->name('admin.add.schedule');
    Route::get('/schedules/{schedule}/edit', [AdminController::class, 'editSchedule'])->name('admin.edit.schedule');
    Route::post('/schedules/{schedule}/edit', [AdminController::class, 'updateSchedule'])->name('admin.update.schedule');
    Route::delete('/schedules/{schedule}', [AdminController::class, 'deleteSchedule'])->name('admin.delete.schedule');

    // Reports for Admin
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
});

// Driver Routes
Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::resource('drivers', DriverController::class);
    Route::get('/driver/qrcode', [DriverController::class, 'generateQRCode'])->name('driver.qrcode');
});

// Checkpoint Routes
Route::middleware(['auth', 'role:checkpoint'])->group(function () {
    Route::get('/checkpoint/scan/{driverId}', [CheckpointController::class, 'scanQRCode']);
});

// Passenger Routes
Route::middleware(['auth', 'role:passenger'])->group(function () {
    Route::get('/passenger/schedules', [PassengerController::class, 'viewBusSchedules']);
    Route::get('/passenger/report', [PassengerReportController::class, 'showReportForm'])->name('passenger.report.form');
    Route::post('/passenger/report', [PassengerReportController::class, 'submitReport'])->name('passenger.report.submit');
});

// Auth Routes (like login, register, etc.)
require __DIR__.'/auth.php';
