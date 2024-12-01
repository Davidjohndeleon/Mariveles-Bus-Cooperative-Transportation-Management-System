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
use App\Http\Controllers\AdminBusBookingController;
use App\Http\Controllers\AdminCheckpointController;

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
    
    Route::get('/admin_dashboard', [AdminController::class, 'gps'])->name('admin.admin.dashboard');

    Route::get('/checkpoints/scanned-checkpoints', [AdminCheckpointController::class,'viewScannedCheckpoints'])->name('admin.checkpoints.scanned-checkpoints');

    Route::get('/buses', [AdminController::class, 'manageBuses'])->name('admin.manage.buses');
    Route::post('/buses', [AdminController::class, 'addBus'])->name('admin.add.bus');
    Route::get('/buses/{bus}/edit', [AdminController::class, 'editBus'])->name('admin.edit.bus');
    Route::put('/buses/{bus}/edit', [AdminController::class, 'updateBus'])->name('admin.update.bus');
    Route::delete('/buses/{id}', [AdminController::class, 'deleteBus'])->name('admin.delete.bus');
    
    
    // Conductor registration
    Route::post('/admin/register/conductor', [AdminController::class, 'registerConductor'])->name('admin.register.conductor');
    Route::get('/admin/register/conductor', [AdminController::class, 'showRegisterConductorForm'])->name('admin.register.conductor.form');

    // Driver registration
    Route::get('/register_driver', [AdminController::class, 'showRegisterDriverForm'])->name('admin.register.driver.form');
    Route::post('/register_driver', [AdminController::class, 'registerDriver'])->name('admin.register.driver');

    // Schedules management
    
    Route::get('/schedules', [AdminController::class, 'manageSchedules'])->name('admin.manage.schedules'); // Manage schedules view
    Route::post('/schedules', [AdminController::class, 'addSchedule'])->name('admin.add.schedule'); 
    Route::get('/schedules/{id}/edit', [AdminController::class, 'editSchedule'])->name('admin.edit.schedule'); 
    Route::put('/schedules/{id}', [AdminController::class, 'updateSchedule'])->name('admin.update.schedule'); 
    Route::delete('/schedules/{schedule}', [AdminController::class, 'deleteSchedule'])->name('admin.delete.schedule'); 
    Route::get('/admin/add-default-schedules', [AdminController::class, 'addDefaultBalangaToMarivelesSchedules'])->name('admin.add.default.schedules');
    Route::post('/admin/add-default-schedules', [AdminController::class, 'addDefaultBalangaToMarivelesSchedules'])->name('admin.add.default.schedules');
    // Reports for Admin
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');

    //Fare Matrix
    Route::get('/admin/fares', [FareController::class, 'index'])->name('fares.index');
    Route::get('/admin/fares/create', [FareController::class, 'create'])->name('fares.create');
    Route::post('/admin/fares', [FareController::class, 'store'])->name('fares.store');
    Route::get('/admin/fares/{id}/edit', [FareController::class, 'edit'])->name('fares.edit');
    Route::put('/admin/fares/{id}', [FareController::class, 'update'])->name('fares.update');
    Route::delete('/admin/fares/{id}', [FareController::class, 'destroy'])->name('fares.destroy');
    Route::get('/admin/fares/edit-all', [FareController::class, 'editAll'])->name('fares.editAll');
    Route::put('/admin/fares/update-all', [FareController::class, 'updateAll'])->name('fares.updateAll');



    //Registration for checkpoint users
    Route::get('/admin/register-checkpoint', [AdminController::class, 'showRegisterCheckpointForm'])->name('admin.register.checkpoint.user.form');
    Route::post('/admin/register-checkpoint', [AdminController::class, 'registerCheckpointUser'])->name('admin.register.checkpoint.user');

    //Admin bus booking requests
    Route::get('/admin/bus.bookings', [AdminBusBookingController::class, 'index'])->name('admin.bus.bookings');
    Route::put('/admin/bookings/{booking}', [AdminBusBookingController::class, 'updateStatus'])->name('admin.bookings.update');
    Route::delete('/admin/bookings/{id}', [AdminBusBookingController::class, 'deleteBooking'])->name('admin.bookings.delete');


});

// Driver Routes
Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::resource('drivers', DriverController::class);
    Route::post('/driver/locping', [DriverController::class, 'locPing'])->name('driver.locping');
    Route::get('/driver/qrcode', [DriverController::class, 'generateQRCode'])->name('driver.qrcode');
    Route::get('/driver/checkpoints', [DriverController::class, 'viewCheckpoints'])->name('drivers.checkpoints');
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

    Route::get('/passenger/bookings', [PassengerController::class, 'viewBusBookings'])->name('passenger.bookings');
    Route::post('/passenger/bus-booking/{busId}', [PassengerController::class, 'requestBusBooking'])->name('passenger.requestBusBooking');
    Route::delete('/passenger/bookings/{id}', [PassengerController::class, 'deleteBooking'])->name('passenger.bookings.delete');

    Route::get('/passenger/gps', [PassengerController::class, 'viewGPS'])->name('passenger.gps');
    

});


// Auth Routes (like login, register, etc.)
require __DIR__.'/auth.php';
