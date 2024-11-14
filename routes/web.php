<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\Employee;
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
    return redirect('/login');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// })->middleware('auth')->name('dashboard.');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.','middleware' => ['auth']], function () {

    Route::put('/update-status/{employee}', [EmployeeController::class, 'updateStatus'])->name('employees.update-status');
    Route::resource('employees', EmployeeController::class);

    Route::put('/user-update-status/{user}', [UserController::class, 'updateStatus'])->name('users.update-status');
    Route::resource('users', UserController::class);

    Route::get('/clock-in', [AttendanceController::class, 'index'])->name('attendances.clock-in');
    Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('attendances.clock-in.store');
    Route::post('/clock-out/{attendance}', [AttendanceController::class, 'clockOut'])->name('attendances.clock-out.store');

    Route::get('/my-attendance', [AttendanceController::class, 'myAttendance'])->name('attendances.my-attendance');
    Route::get('/my-attendance/{attendance}', [AttendanceController::class, 'editMyAttendance'])->name('attendances.my-attendance.edit');
    Route::put('/my-attendance/{attendance}', [AttendanceController::class, 'updateMyAttendance'])->name('attendances.my-attendance.update');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout']);
