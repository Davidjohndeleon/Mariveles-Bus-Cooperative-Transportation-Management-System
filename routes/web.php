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
use App\Http\Controllers\FareController;

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
// Route accessible by everyone
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
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
    
    Route::get('/buses', [AdminController::class, 'manageBuses'])->name('admin.manage.buses');
    Route::post('/buses', [AdminController::class, 'addBus'])->name('admin.add.bus');
    Route::get('/buses/{bus}/edit', [AdminController::class, 'editBus'])->name('admin.edit.bus');
    Route::post('/buses/{bus}/edit', [AdminController::class, 'updateBus'])->name('admin.update.bus');
    Route::delete('/buses/{id}', [AdminController::class, 'deleteBus'])->name('admin.delete.bus');
    
    //Route::get('/schedules', [AdminController::class, 'showSchedules'])->name('schedules');
    Route::get('/admin/admin_dashboard', [AdminController::class, 'gps'])->name('admin.admin.dashboard');
    Route::post('/admin/schedule/add', [AdminController::class, 'addSchedule'])->name('admin.add.schedule');
    Route::post('/admin/schedule/update/{id}', [AdminController::class, 'updateSchedule'])->name('admin.update.schedule');
    
    // Conductor registration
    Route::post('/admin/register/conductor', [AdminController::class, 'registerConductor'])->name('admin.register.conductor');
    Route::get('/admin/register/conductor', [AdminController::class, 'showRegisterConductorForm'])->name('admin.register.conductor.form');

    // Driver registration
    Route::get('/register_driver', [AdminController::class, 'showRegisterDriverForm'])->name('admin.register.driver.form');
    Route::post('/register_driver', [AdminController::class, 'registerDriver'])->name('admin.register.driver');

    // Schedules management
    Route::get('/schedules', [AdminController::class, 'manageSchedules'])->name('admin.manage.schedules'); // Manage schedules view
    Route::post('/schedules', [AdminController::class, 'addSchedule'])->name('admin.add.schedule'); // Add a new schedule
    Route::get('/schedules/{schedule}/edit', [AdminController::class, 'editSchedule'])->name('admin.edit.schedule'); // Edit schedule
    Route::post('/schedules/{schedule}/edit', [AdminController::class, 'updateSchedule'])->name('admin.update.schedule'); // Update schedule
    Route::delete('/schedules/{schedule}', [AdminController::class, 'deleteSchedule'])->name('admin.delete.schedule'); // Delete schedule
    Route::get('/admin/add-default-schedules', [AdminController::class, 'addDefaultBalangaToMarivelesSchedules'])->name('admin.add.default.schedules');
    Route::post('/admin/add-default-schedules', [AdminController::class, 'addDefaultBalangaToMarivelesSchedules'])
    ->name('admin.add.default.schedules');
    // Reports for Admin
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');

    //Fare Matrix
    Route::get('/admin/fares', [FareController::class, 'index'])->name('fares.index');
    Route::get('/admin/fares/create', [FareController::class, 'create'])->name('fares.create');
    Route::post('/admin/fares', [FareController::class, 'store'])->name('fares.store');
    Route::get('/admin/fares/{id}/edit', [FareController::class, 'edit'])->name('fares.edit');
    Route::put('/admin/fares/{id}', [FareController::class, 'update'])->name('fares.update');
    Route::delete('/admin/fares/{id}', [FareController::class, 'destroy'])->name('fares.destroy');


    //Registration for checkpoint users
    Route::get('/admin/register-checkpoint', [AdminController::class, 'showRegisterCheckpointForm'])->name('admin.register.checkpoint.user.form');
    Route::post('/admin/register-checkpoint', [AdminController::class, 'registerCheckpointUser'])->name('admin.register.checkpoint.user');
});

// Driver Routes
Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::resource('drivers', DriverController::class);
    Route::get('/driver/qrcode', [DriverController::class, 'generateQRCode'])->name('driver.qrcode');
    Route::get('/driver/checkpoints', [DriverController::class, 'viewCheckpoints'])->name('driver.checkpoints');
    Route::post('/driver/checkpoints/{checkpoint}', [DriverController::class, 'markCheckpointComplete'])->name('driver.completeCheckpoint');
});

// Checkpoint Routes
Route::middleware(['auth', 'role:checkpoint'])->group(function () {
    Route::get('/checkpoint/scan', [CheckpointController::class, 'showScanForm'])->name('checkpoint.scan.form');
    Route::post('/checkpoint/scan', [CheckpointController::class, 'scanQRCode'])->name('checkpoint.scan');
    Route::get('/checkpoint/success', [CheckpointController::class, 'success'])->name('checkpoint.success');
    Route::post('/checkpoint/complete/{id}', [CheckpointController::class, 'markComplete'])->name('checkpoint.complete');
});

// Passenger Routes
Route::middleware(['auth', 'role:passenger'])->group(function () {
    Route::get('/passenger/schedules', [PassengerController::class, 'viewBusSchedules'])->name('passenger.schedules');
    Route::get('/passenger/report', [PassengerReportController::class, 'showReportForm'])->name('passenger.report.form');
    Route::post('/passenger/report', [PassengerReportController::class, 'submitReport'])->name('passenger.report.submit');
});

// Auth Routes (like login, register, etc.)
require __DIR__.'/auth.php';
